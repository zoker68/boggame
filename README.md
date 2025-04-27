# Additional information:

For testing this API, you can use [Postman](https://www.getpostman.com/).

My API points in Postman: [https://www.postman.com/blue-crescent-369451/workspace/bog-test](https://www.postman.com/blue-crescent-369451/workspace/bog-test)

# Test:

## Controllers:

* [CreateAccountController](https://github.com/zoker68/boggame/blob/master/app/Http/Controllers/Account/CreateAccountController.php)
* [ProcessTransactionController](https://github.com/zoker68/boggame/blob/master/app/Http/Controllers/Transaction/ProcessTransactionController.php)

## Models:

* [User](https://github.com/zoker68/boggame/blob/master/app/Models/User.php)
* [Transaction](https://github.com/zoker68/boggame/blob/master/app/Models/Transaction.php)

## Validations in requests:

* [CreateAccountRequest](https://github.com/zoker68/boggame/blob/master/app/Http/Requests/CreateAccountRequest.php)
* [TransactionRequest](https://github.com/zoker68/boggame/blob/master/app/Http/Requests/TransactionRequest.php)

## Exceptions:

* [NotEnoughBalanceException](https://github.com/zoker68/boggame/blob/master/app/Exceptions/NotEnoughBalanceException.php)  
* [TransactionDuplicateException](https://github.com/zoker68/boggame/blob/master/app/Exceptions/TransactionDuplicateException.php)

## Database migrations:

* [ALL](https://github.com/zoker68/boggame/tree/master/database/migrations)

# Routes:

* [API](https://github.com/zoker68/boggame/blob/master/routes/api.php)

# Render exception:
* [RenderException](https://github.com/zoker68/boggame/blob/master/app/Classes/RenderException.php)

# Catching exceptions:
* [Bootstrap/app.php](https://github.com/zoker68/boggame/blob/master/bootstrap/app.php)

I have double check for transaction duplication and balance.
First i check conditions before SQL request. Then i try to catch SQL exception

To check balance i use `hasEnoughBalance` method in `User` model. After that i decrease balance in `decreaseBalance` method in `User` model and try to catch `QueryException`.

To check for duplicate transaction i use `TrasactionRequest` class with `unique:transactions` rule and then i use `after` method to throw `DoubleTransactionException`.
After that i try to catch `UniqueConstraintViolationException` when transaction is creating.

Before transaction creation i use `DB::beginTransaction`. And if i catch `UniqueConstraintViolationException` i rollback database transactions.
