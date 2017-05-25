### Waze SDK

This SDK is based on waze calls. We can't find any Docs about waze api.

### How to install

```
composer require esilvajr/waze-sdk
```

### How to use

```
$waze = new \Waze\Waze('API-KEY');

$result = $waze->maps()->place()->autocomplete([
    'input' => 'ADDRESS',
]);
```

