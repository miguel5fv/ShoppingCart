package domain.services;

import domain.valueobjects.Currency;

/**
 * Created by mflorido on 10/07/16.
 */
public interface CurrencyExchangeInterface {
    float changeCurrency(float price, Currency $toConvert);
}
