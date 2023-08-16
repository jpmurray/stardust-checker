# Stardust Checker

Small Laravel Zero CLI app to check the availability of Stardust instances at Scaleway. It will send a Desktop notification if there is an instance available.

Needs PHP installed.

## How to

Copy `.env.example` to `.env` and fill in your Scaleway API token.

Then use the following command : `php stardust check` to check for avalability.

You can (should!) add it to a cronjon for easy checking :

```
* * * * * php /path-to/stardust schedule:run >> /dev/null 2>&1
```

## License

Laravel Zero is an open-source software licensed under the MIT license.
