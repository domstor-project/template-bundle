##Изменения в 1.7.x

###Конфигурация

* Новый формат конфигурации не совместима с предыдущими версиями:

Было
```yaml
domstorlib:
        builder:
            org_id: 13
            location_id: 2004
            cache_dir:
            cache_type:
            cache_time: 86400
            filter_template_dir: '%kernel.root_dir%/../src/AppBundle/Resources/views/Filters'
```


Стало
```yaml
domstor_template:
    domstorlib:
        builder:
            org_id: 13
            location_id: 2004
            cache:
              type: 'file'
              time: 86400
              uniq_key: '13'
              options:
                directory: '%kernel.cache_dir%'
            filter:
              template_dir: '%kernel.root_dir%/../src/AppBundle/Resources/views/Filters'
```
* Новая ветка настроек `links`, предназначенная для переключения города для поиска недвижимости. Порядок перечисления настроек в конфигурации влияет на порядок переключения локаций
```yaml
links:
            2004: 'Недвижимость в Кемерово'
            43: 'Недвижимость в Кемеровской области'
```

###Блоки

* Добавлен блок для смены города/региона

`domstor.template.block.switch_location.service`

Требует подключения скриптов на той странице, где рендерится
`'https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.2.0/js.cookie.min.js'`
`'@DomstorTemplateBundle/Resources/public/js/switch_location.js'`

Вывод на страницу
```twig
{{ sonata_block_render({'type':'domstor.template.block.switch_location.service'}, {'current_location': currentLocation} ) }}
```
`current_location` - параметр, показывающий, для какого населенного пункта в данный момент идет поиск