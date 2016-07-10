package domain.services;

import domain.valueobjects.Currency;

import javax.inject.Inject;

/**
 * Created by mflorido on 09/07/16.
 */
public class CurrencyExchangeLocal implements CurrencyExchangeInterface{
    private Currency base;

    @Inject
    public CurrencyExchangeLocal(Currency base){

        this.base = base;
    }

    @Override
    public float changeCurrency(float price, Currency toConvert) {
        String exchangeSymbols   = this.base.symbol + toConvert.symbol;
        //float rate               = this.currencyRepository.retrieve(exchangeSymbols);
        float rate = (float) 1.123;

        return 0 == rate ? 0: rate * price;
    }
}
