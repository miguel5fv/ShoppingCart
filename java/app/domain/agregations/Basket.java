package domain.agregations;

import domain.entities.Product;
import domain.enums.BasketStatus;
import org.apache.commons.lang3.ArrayUtils;
import org.apache.commons.lang3.SystemUtils;

import java.util.Collection;
import java.util.HashMap;
import java.util.Map;
import java.util.Set;

/**
 * Created by mflorido on 09/07/16.
 */
public class Basket {
    /**
     * @var int
     */
    private int id;
    /**
     * @var int
     */
    private int maxProducts;
    /**
     * @var int
     */
    private int maxDifferentProducts;
    /**
     * @var float
     */
    private float totalAmount     = 0;
    /**
     * @var array
     */
    private Map<Integer, Product> products;
    /**
     * @var array
     */
    private Map<Integer, Integer> productsAmount;

    public Basket(int id, int maxProducts, int maxDifferentProducts) {
        this.id = id;
        this.maxProducts = maxProducts;
        this.maxDifferentProducts = maxDifferentProducts;
        this.products = new HashMap<>();
        this.productsAmount = new HashMap<>();
    }

    public BasketStatus addProduct(Product product, int amount) {
        if (this.maxProducts >= amount && this.productFitsInBasket(product.id))
        {
            this.removeProduct(product.id);
            this.products.put(product.id, product);
            this.productsAmount.put(product.id, amount);
            this.totalAmount  += this.getTotalAmountProducts(product, amount);

            return BasketStatus.ADD_PRODUCT_OK;
        }
        return this.maxProducts >= amount ? BasketStatus.ADD_PRODUCT_FULL_BASKET: BasketStatus.ADD_PRODUCT_MAX_UNITS;
    }

    /**
     * Checks if a new products could be fitted into a basket.
     *
     * @param idProduct
     * @return boolean
     */
    private boolean productFitsInBasket(int idProduct)
    {
        return null != this.products.get(idProduct)
                        || this.maxDifferentProducts > this.products.size();
    }

    /**
     * Remove a product if exists.
     *
     * @param idProduct
     * @return boolean
     */
    public boolean removeProduct(int idProduct)
    {
        if (null != this.products.get(idProduct)) {
            Product product = this.products.get(idProduct);
            int productAmount  = this.getProductAmount(idProduct);

            this.products.remove(idProduct);
            this.productsAmount.remove(idProduct);

            this.totalAmount -= this.getTotalAmountProducts(product, productAmount);

            return true;
        }
        return false;
    }

    /**
     * Retrieve the total price for the amount of products and applying the offer prices when is required.
     *
     * @param product
     * @param productAmount
     *
     * @return float
     */
    private float getTotalAmountProducts(Product product, int productAmount)
    {
        if (product.minAmountForOffer <= productAmount)
            return productAmount * product.offerPrice;
        return productAmount * product.unitPrice;
    }

    /**
     * Retrieve the number of products stored in basket by its id.
     *
     * @param idProduct
     * @return int
     */
    public int getProductAmount(int idProduct)
    {
        if (null != this.products.get(idProduct))
            return this.productsAmount.get(idProduct);
        return 0;
    }

    /**
     * Returns the total amount.
     *
     * @return float
     */
    public float getTotalAmount()
    {
        return this.totalAmount;
    }
    /**
     * Retrieve all the products storaged
     *
     * @return array
     */
    public Map<Integer, Product> getProducts()
    {
        return this.products;
    }
    /**
     * Returns the id of the basket.
     *
     * @return int
     */
    public int getId()
    {
        return this.id;
    }
    /**
     * Retrieve all the amount products registered.
     *
     * @return array
     */
    public Map<Integer, Integer> getProductsAmount()
    {
        return this.productsAmount;
    }
}
