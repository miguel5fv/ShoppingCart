package domain.entities;

/**
 * Created by mflorido on 09/07/16.
 */
public class Product {
    public int id;
    public float unitPrice;
    public float offerPrice;
    public int minAmountForOffer;
    public int amount;

    public Product() {
        this(0,0,0,0,0);
    }

    /**
     * @param id
     * @param unitPrice
     * @param offerPrice
     * @param minAmountForOffer
     * @param amount
     */
    public Product(
            int id,
            float unitPrice,
            float offerPrice,
            int minAmountForOffer,
            int amount
    ) {

        this.id = id;
        this.unitPrice = unitPrice;
        this.offerPrice = offerPrice;
        this.minAmountForOffer = minAmountForOffer;
        this.amount = amount;
    }
}
