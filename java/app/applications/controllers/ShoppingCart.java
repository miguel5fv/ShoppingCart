package applications.controllers;

import domain.entities.Product;
import org.apache.http.client.HttpClient;
import org.apache.http.client.ResponseHandler;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.BasicResponseHandler;
import org.apache.http.impl.client.HttpClientBuilder;
import play.mvc.*;

/**
 * This controller contains an action to handle HTTP requests
 * to the application's home page.
 */
public class ShoppingCart extends Controller {
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
        Product product = new Product(id, unitPrice, offerPrice, minAmountForOffer, amount);
        return ok("Product added: " + product.id + " " + product.unitPrice + " " + product.offerPrice + " " + product.minAmountForOffer + " " + product.amount);
        //return ok("Product added: " + id + " " + unitPrice);
    }

    public Result removeProduct() {
        return ok("Product removed");
    }

    public Result totalAmount() {
        return ok("Total: 10 US$");
    }

    public Result currencyExchange() {
        return ok("From 10 US$ to 123 CA$");
    }
}
