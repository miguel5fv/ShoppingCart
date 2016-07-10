package applications.controllers;

import domain.entities.Product;
import domain.enums.BasketStatus;
import domain.services.ShoppingCartInterface;
import domain.valueobjects.Currency;
import org.apache.http.client.HttpClient;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.HttpClientBuilder;
import play.mvc.*;

import javax.inject.Inject;

/**
 * This controller contains an action to handle HTTP requests
 * to the application's home page.
 */
public class ShoppingCart extends Controller {
    private final ShoppingCartInterface shoppingCart;

    @Inject
    public ShoppingCart(ShoppingCartInterface shoppingCart) {
        super();
        this.shoppingCart   = shoppingCart;
    }

    /**
     * @param id
     * @param unitPrice
     * @param offerPrice
     * @param minAmountForOffer
     * @param amount
     *
     * @return Result
     */
    public Result addProduct(
            int id,
            float unitPrice,
            float offerPrice,
            int minAmountForOffer,
            int amount
    ) {
       Product product = new Product(id, unitPrice, offerPrice, minAmountForOffer);
       BasketStatus additionFeedback = this.shoppingCart.addProduct(product, amount);

       switch (additionFeedback) {
           case ADD_PRODUCT_OK:
               return ok("Product added");
           case ADD_PRODUCT_FULL_BASKET:
               return internalServerError("Error: Basket full");
           case ADD_PRODUCT_MAX_UNITS:
               return internalServerError("Error: Maximum number of units");
           default:
               return internalServerError("Other error");
       }
   }

    /**
     * @param id
     *
     * @return Result
     */
    public Result removeProduct(int id) {
        if (this.shoppingCart.removeProduct(id))
            return ok("Product removed: " + id);
        else
            return notFound();
    }

    /**
     * @return Result
     */
    public Result totalAmount() {

        return ok("Total: " + this.shoppingCart.totalAmount());
    }

    /**
     * @param symbol
     *
     * @return Result
     */
    public Result currencyExchange(String symbol) {
        Currency currency = new Currency();
        currency.symbol = symbol;

        return ok("From 10 US$ to " + this.shoppingCart.changeCurrency(currency));
    }
}
