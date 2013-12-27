<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';
//
require 'bootstrap.php';

use OvCart\CartManager;

/**
 * Features context.
 */
class FeatureContext extends BehatContext {

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    private $cartManager;
    private $item;
    private $items;

    public function __construct(array $parameters) {
        // Initialize your context here      
        $this->cartManager = new CartManager('BDD Test Manager');
    }

    /**
     * Scenario: Adicionar um item no carrinho
     * 
     * @Given /^Eu escolhi o item "([^"]*)"$/
     */
    public function euEscolhiOItem($arg1) {
        $item = new \OvCart\Item();
        $item->seId(rand(1, 10));
        $item->setName($arg1);

        $this->items[] = $item;
        $this->item = $item;
    }

    /**
     * 
     * @When /^Eu adiciono esse item no carrinho$/
     */
    public function euAdicionoEsseItemNoCarrinho() {
        $this->cartManager->cart()->addItem($this->item);
    }

    /**
     * @Then /^o item deve estar no carrinho$/
     */
    public function osItemDeveEstarNoCarrinho() {

        $itemAdded = $this->cartManager->cart()->getItemById($this->item->getId());
        assertTrue($itemAdded instanceof \OvCart\Item && $itemAdded->getId() == $this->item->getId());
    }

    /**
     * Scenario: Remover item 
     * 
     * @Given /^Eu seleciono o item "([^"]*)"$/
     */
    public function euSelecionoOItem($arg1) {
        foreach ($this->cartManager->cart()->getItems() as $item) {
            if ($item->getName() == $arg1) {
                $this->item = $item;
            }
        }
    }

    /**
     * @When /^Eu removo o item selecionado$/
     */
    public function euRemovoOItemSelecionado() {
        $this->cartManager->cart()->removeItem($this->item);
    }

    /**
     * @Then /^o item não deve estar mais no carrinho$/
     */
    public function oItemNaoDeveEstarMaisNoCarrinho() {
        assertCount(0, $this->cartManager->cart()->getItems());
    }

    /**
     * @Then /^os itens devem estar no carrinho$/
     */
    public function osItensDevemEstarNoCarrinho() {
        foreach ($this->items as $item) {
            assertTrue($this->cartManager->cart()->getItemById($item->getId()) instanceof \OvCart\Item);
        }
    }

    /**
     * @Given /^Eu esvazio o carrinho$/
     */
    public function euEsvazioOCarrinho() {
       $this->cartManager->cart()->emptyCart();
    }

    /**
     * @Then /^não deve ter nenhum item$/
     */
    public function naoDeveTerNenhumItem() {
        assertCount(0,$this->cartManager->cart()->getItems());
    }
}
