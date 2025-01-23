# PHP Seravo API

A simple, object-oriented wrapper for the Seravo API, written in PHP.

Uses [Order Module API](https://api.seravo.com/order/docs#/) & [Public Module API](https://api.seravo.com/public/docs#/).

## Requirements

- PHP >= 8.2

The following environment variables are required to be set before using the library:

- `SERAVO_API_CLIENT_ID`
- `SERAVO_API_SECRET`

Optionally, you may pass these environment variables as well:

- `SERAVO_ENVIRONMENT`
    - Defines the API environment (`testing`, `staging`, `production`) to be used. Defaults to `production` if omitted from `.env` and/or constructor.

These values must be set in the `/.env` file. See `.env.example`.

## Examples

See the examples directory for more detailed information about how to use the library.
