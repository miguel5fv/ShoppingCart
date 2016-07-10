package domain.services;

import domain.agregations.Basket;
import domain.entities.Product;
import domain.enums.BasketStatus;
import domain.valueobjects.Currency;

import javax.inject.Inject;

/**
 * Created by mflorido on 09/07/16.
 */
public class ShoppingCartCaseStudy implements ShoppingCartInterface {

    private final Basket basket;

    @Inject
    public ShoppingCartCaseStudy(Basket basket)
    {
        this.basket = basket;
    }

    @Override
    public BasketStatus addProduct(Product product, int amount) {
        BasketStatus isAdded    = this.basket.addProduct(product, amount);
        if (BasketStatus.ADD_PRODUCT_OK  == isAdded) {
            System.out.print(basket.getProductsAmount() + " " + basket.getTotalAmount());
        }
        return isAdded;
    }

    @Override
    public boolean removeProduct(int id) {
        boolean isRemoved  = this.basket.removeProduct(id);
        if (true == isRemoved) {
            System.out.print("Product deleted: " + id);
        }
        return isRemoved;
    }

    @Override
    public float totalAmount() {
        return this.basket.getTotalAmount();
    }

    @Override
    public float changeCurrency(Currency currency) {
        return 0;
    }
}
