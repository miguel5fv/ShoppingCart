package domain.services;

import domain.entities.Product;
import domain.valueobjects.Currency;

/**
 * Created by mflorido on 10/07/16.
 */
public interface ShoppingCartInterface {

    /**
     *  Adds a new method
     * @param product
     * @param amount
     * @return boolean
     */
    boolean addProduct(Product product, int amount);

    /**
     * Remove a given product
     *
     * @param id
     * @return boolean
     */
    boolean removeProduct(int id);

    /**
     * Returns the total amount.
     *
     * @return float
     */
    float totalAmount();

    /**
     * Give the total amount in other currency.
     *
     * @param currency
     * @return float
     */
    float changeCurrency(Currency currency);
}
