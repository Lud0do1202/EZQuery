# EZQuery

## Set up
- Update the const of *config.php*
```php
define('HOST', 'host');
define('DB_NAME', 'database');
define('USERNAME', 'username');
define('PASSWORD', 'password');
```
### Several config files
- Update path of the require in *EZQuery.php*
```php
require_once "./config.php";
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
      "lastname" = "Aaaa",
      "firstname" = "Bbbb",
    ],
  [1] => [
      "lastname" = "MyLastname",
      "firstname" = "MyFirstname",
    ],
  [2] => [
      "lastname" = "Ça va être tout noir",
      "firstname" = "Ta gueule",
    ]
]
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
$activeBestSellers = $ez->executeSelect(
        "SELECT lastname, firstname FROM sellers 
        WHERE is_active = % and nbSales >= ?", "true", 100);
```

---
## Debug
- It will echo the query and the args
```php
$ez = new EZQuery();
$ez->debug();
$id = 2;
$user = $ez->executeSelect("SELECT lastname, firstname FROM users WHERE id = ?", $id);
```
```html
SELECT lastname, firstname FROM users WHERE id = ?
Array(
  [0] = 2
)
```