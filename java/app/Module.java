import com.google.inject.AbstractModule;
import domain.agregations.Basket;
import domain.services.CurrencyExchangeInterface;
import domain.services.CurrencyExchangeLocal;
import domain.services.ShoppingCartCaseStudy;
import domain.services.ShoppingCartInterface;
import domain.valueobjects.Currency;

import java.time.Clock;

/**
 * This class is a Guice module that tells Guice how to bind several
 * different types. This Guice module is created when the Play
 * application starts.
 *
 * Play will automatically use any class called `Module` that is in
 * the root package. You can create modules in other locations by
 * adding `play.modules.enabled` settings to the `application.conf`
 * configuration file.
 */
public class Module extends AbstractModule {

    @Override
    public void configure() {
        // Use the system clock as the default implementation of Clock
        bind(Clock.class).toInstance(Clock.systemDefaultZone());

        bind(ShoppingCartInterface.class).to(ShoppingCartCaseStudy.class);
        bind(Basket.class).toInstance(new Basket(1, 10, 3));

        Currency base = new Currency();
        base.symbol = "Eur";
        bind(CurrencyExchangeInterface.class).toInstance(new CurrencyExchangeLocal(base));
    }

}
