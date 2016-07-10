package domain.services;

import domain.entities.Product;
import domain.valueobjects.Currency;

/**
 * Created by mflorido on 09/07/16.
 */
public class ShoppingCartCaseStudy implements ShoppingCartInterface {

    @Override
    public boolean addProduct(Product product, int amount) {
        System.out.print("Product added: " + product.id + " " + product.unitPrice + " " + product.offerPrice + " " + product.minAmountForOffer + " " + amount);
        return true;
    }

    @Override
    public boolean removeProduct(int id) {
        System.out.print("Product removed: " + id);
        return true;
    }

    @Override
    public float totalAmount() {
        return 0;
    }

    @Override
    public float changeCurrency(Currency currency) {
        return 0;
    }
}
