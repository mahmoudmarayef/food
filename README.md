Installation

Clone the repo and cd into it

composer install

Rename or copy .env.example file to .env

php artisan key:generate

Set your database credentials in your .env file

Set your Stripe credentials in your .env file. Specifically STRIPE_KEY and STRIPE_SECRET

Set your Algolia credentials in your .env file. Specifically ALGOLIA_APP_ID and ALGOLIA_SECRET. See this episode.

Set your Braintree credentials in your .env file if you want to use PayPal. Specifically BT_MERCHANT_ID, BT_PUBLIC_KEY, BT_PRIVATE_KEY. 

php artisan ecommerce:install. This will migrate the database and run any seeders necessary. See this episode.

npm install

npm run dev

php artisan serve or use Laravel Valet or Laravel Homestead

Visit localhost:8000 in your browser

Visit /admin if you want to access the Voyager admin backend. Admin User/Password: admin@admin.com/password.
