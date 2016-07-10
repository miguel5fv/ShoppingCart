package applications.controllers;

import domain.entities.Product;
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
     * An action that renders an HTML page with a welcome message.
     * The configuration in the <code>routes</code> file means that
     * this method will be called when the application receives a
     * <code>GET</code> request with a path of <code>/</code>.
     */
   public Result addProduct(
            int id,
            float unitPrice,
            float offerPrice,
            int minAmountForOffer,
            int amount
    ) {
       Product product = new Product(id, unitPrice, offerPrice, minAmountForOffer);
       if (this.shoppingCart.addProduct(product, amount))
           return ok("Product added");
       else
           return internalServerError("Error while storing");
   }

    public Result removeProduct(int id) {
        if (this.shoppingCart.removeProduct(id))
            return ok("Product removed");
        else
            return notFound();
    }

    public Result totalAmount() {

        return ok("Total: " + this.shoppingCart.totalAmount());
    }

    public Result currencyExchange(String symbol) {
        Currency currency = new Currency();
        currency.symbol = symbol;

        return ok("From 10 US$ to " + this.shoppingCart.changeCurrency(currency));
    }
}
