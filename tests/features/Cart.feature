Feature: Carrinho
    Como Usuario 
    quero adicionar, remover, e visualizar itens do carrinho
    para gerenciar os produtos que quero comprar

Scenario: Adicionar um item no carrinho
    Given Eu escolhi o item "Camisa Nike"
    When  Eu adiciono esse item no carrinho
    Then  o item deve estar no carrinho

Scenario: Remover item
    Given Eu seleciono o item "Camisa Nike"
    When Eu removo o item selecionado
    Then o item não deve estar mais no carrinho

Scenario: Adicionar varios itens no carrinho
    Given Eu escolhi o item "Camisa Puma"
     And  Eu escolhi o item "Calça jeans"
     And  Eu escolhi o item "Tenis nerd"
    When  Eu adiciono os itens no carrinho
    Then  os itens devem estar no carrinho

Scenario: Limpar carrinho
    Given Eu escolhi o item "Camisa Velha"
     And  Eu escolhi o item "Luva de lã"
    When  Eu adiciono os itens no carrinho
     And  Eu esvazio o carrinho
    Then  não deve ter nenhum item  