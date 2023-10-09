# EZQuery

## Set up

- Update the const of _config.php_

```php
define('HOST', 'SET_HOST');
define('DB_NAME', 'SET_DB_NAME');
define('USERNAME', 'SET_USERNAME');
define('PASSWORD', 'SET_PASSWORD');
```

---

## Select query

```php
$ez = new EZQuery();
$users = $ez->executeSelect("SELECT lastname, firstname FROM users");
```

```php
$users = [
  [0] => [
      "lastname" = "Doe",
      "firstname" = "John",
    ],
  [1] => [
      "lastname" = "Doe",
      "firstname" = "Jane",
    ],
  [2] => [
      "lastname" = "Patel",
      "firstname" = "Aisha",
    ]
]
```

---

## Select query (empty)

```php
$ez = new EZQuery();
$user = $ez->executeSelect("SELECT lastname, firstname FROM users WHERE id = ", 100);
```

```php
$user = []
```

---

## Edit query (Insert, Delete, Update, ...)

```php
$ez = new EZQuery();
$nbRowsAffected = $ez->executeEdit("INSERT INTO users (lastname, firstname) VALUES (?, ?)", $lastname, $firstname);
```

```php
$nbRowsAffected = 1 --> One user inserted
```

---

## Binding

- The '%' will be replace by the arg
- The '?' will bind the arg
- The '\\' will be used to escape the next char

```php
$ez = new EZQuery();
$fields = "lastname, firstname";
$userID = 0;
$user = $ez->executeSelect("SELECT % FROM users WHERE id = ?", $fields, $userID);
```

```php
$user = [
  [0] => [
      "lastname" = "Doe",
      "firstname" = "John",
    ],
]
```

---

## Debug

- It will echo the query and the args

```php
$ez = new EZQuery();
$ez->debug();
$id = 0;
$user = $ez->executeSelect("SELECT lastname, firstname FROM users WHERE id = ?", $id);
$ez->debug(false);
```

```html
SELECT lastname, firstname FROM users WHERE id = ?

Array ( [0] => 0 )
```

---

## Demo

- To run the demo you have to create a DB named **'demo_ezquery'** and the SQL to generate the DB is in *./demo/demo_ezquery.sql*
- Do a git clone
- Open the page *./demo/demo.php*
