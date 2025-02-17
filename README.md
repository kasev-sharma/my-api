## Passport Install CMD

```
php artisan passport:client --personal;
```

## Make Passport Keys

```
php artisan passport:keys
```

## DB Refresh CMD

```
php artisan migrate:refresh;
```

## Docs Generation CMD

```
php artisan l5-swagger:generate;
```

## Intelliscence Generation CMD

```
php artisan ide-helper:generate; php artisan ide-helper:meta; php artisan ide-helper:models --nowrite;
```

## Cache Clear CMD

```
php artisan cache:clear; php artisan config:clear;
php artisan view:clear;
php artisan route:clear;
```

## Change in php.ini
```
upload_max_filesize = 100M
post_max_size = 100M

max_execution_time = 300   ; Allow longer execution time (300 seconds = 5 minutes)
memory_limit = 256M        ; Increase memory limit to handle large data
```