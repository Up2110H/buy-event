## Зависимости
* _php ~7.2_
* _php7.2-sqlite_

## Установка

```
git clone https://github.com/Up-2-110H/buy-event.git app-path
app-path> composer install
```

для создания файла базы данных используем команду:
```
app-path> php yii migrate
```
или переименуем файл `/db/buy-event.db-dist` на `/db/buy-event.db`

## Использование

Изначально отправляемые сообщения будут сохранены в папки `/runtime/mail` и `/runtime/sms`.
Для реальной отправки писем настройте в файле `/config/console.php` конфигурации соответствующих компонентов
`mailer` и `sms` и установите `useFileTransport` как `false`:
```
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',

            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'sms' => [
            'class' => 'wadeshuler\sms\twilio\Sms',

            // send all sms to a file by default. You have to set
            // 'useFileTransport' to false and configure the messageConfig['from'],
            // 'sid', and 'token' to send real messages
            'useFileTransport' => true,

            // Find your Account Sid and Auth Token at https://twilio.com/console
            'sid' => 'ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            'token' => 'your_auth_token',

            // Tell Twilio where to POST information about your message.
            // @see https://www.twilio.com/docs/sms/send-messages#monitor-the-status-of-your-message
            //'statusCallback' => 'https://example.com/path/to/callback',      // optional
        ],```

С помощью команды:
```
php yii help command-name
```
можно увидеть описание команды `comand-name`

### Команды:

#### user/create
**_Создает пользователя по номеру телефона и электронной почте_**

|Параметр|Тип   |Необходим?|Описание                                                    |
|--------|------|----------|------------------------------------------------------------|
|--phone |string|Да        |Номер телефона (пример: --phone="+123456789")               |
|--email |string|Да        |Адрес электронной почты (пример: --email="example@test.com")|

#### user/show
**_Показывает всех пользователей_**

|Параметр|Тип   |Необходим?|Описание|
|--------|------|----------|--------|
|Нет     |Нет   |Нет       |Нет     |

#### purchase/create
**_Создает покупку по идентификатору пользователя, названию продукта и цене продукта_**

|Параметр |Тип   |Необходим?|Описание                                                      |
|---------|------|----------|--------------------------------------------------------------|
|--user   |int   |Да        |Идентификатор пользователя в таблице `user` (пример: --user=1)|
|--product|string|Да        |Название продукта (пример: --product="milk")                  |
|--price  |int   |Да        |Цена товара в долларах (пример: --price=5)                    |

#### purchase/show
**_Показывает все покупки_**

|Параметр|Тип   |Необходим?|Описание|
|--------|------|----------|--------|
|Нет     |Нет   |Нет       |Нет     |

#### send/mail
**_Посылает письмо о недавней покупке_**

|Параметр|Тип   |Необходим?|Описание                                                                                                        |
|--------|------|----------|----------------------------------------------------------------------------------------------------------------|
|--user  |int   |Нет       |Идентификатор пользователя в таблице `user` (пример: --user=1)<br>если не указан, будут выбраны все пользователи|

#### send/sms
**_Отправляет сообщение на номер телефона о недавной покупке_**

|Параметр|Тип   |Необходим?|Описание                                                                                                        |
|--------|------|----------|----------------------------------------------------------------------------------------------------------------|
|--user  |int   |Нет       |Идентификатор пользователя в таблице `user` (пример: --user=1)<br>если не указан, будут выбраны все пользователи|

