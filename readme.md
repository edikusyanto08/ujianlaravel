## Installation Requirements

- SAS project require master database from <a href="https://gitlab.com/semaya/master-migrator">Semaya Master Migrator</a>

## Installation Setup

- Create database ``semaya_sas``
- Copy ``snappy.php.example`` file to ``snappy.php`` in ``config`` folder
- Open ``snappy.php`` file and modify these lines:

  <pre>
  'pdf' => array(
      ...
      'binary'  => '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"',
      // 'binary'  => base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
      ...
  ),
  'image' => array(
      ...
      'binary'  => '"C:\Program Files\wkhtmltoimage\bin\wkhtmltoimage"',
      // 'binary'  => base_path('vendor/h4cc/wkhtmltoimage-amd64/bin/wkhtmltoimage-amd64'),
      ...
  ),
  </pre>

  Change ``binary`` with ``base_path('...')`` if your server using linux or change ``binary`` with ``C:\..`` if your server using windows.

- Copy ``.env.example`` file to ``.env``
- Open ``.env`` file and modify these lines with your configuration settings:

  <pre>
  DB_MASTER_DATABASE=YOUR_MASTER_DATABASE
  DB_DATABASE=YOUR_DATABASE
  DB_USERNAME=YOUR_SQL_USERNAME
  DB_PASSWORD=YOUR_SQL_PASSWORD
  </pre>

  ``DB_MASTER_DATABASE`` is your master database name from <a href="https://gitlab.com/semaya/master-migrator">Semaya Master Migrator</a>

- Open Terminal and navigate to your project, then write:

  <pre>composer install</pre>

- Copy and replace ``zizaco`` folder in ``vendor`` folder with ``zizaco`` folder in root project directory:

- Then write these command:

  <pre>php artisan key:generate</pre>

- Then write these command:

  <pre>php artisan migrate --seed</pre>

- And finally, write these command:

  <pre>php artisan config:cache</pre>
