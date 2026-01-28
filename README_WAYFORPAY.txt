WAYFORPAY SETUP (для лендінгу)

1) Завантаж на хостинг файли:
   - index.html
   - усі картинки
   - pay.php

2) Відкрий pay.php і впиши:
   - YOUR_MERCHANT_ACCOUNT
   - YOUR_MERCHANT_SECRET_KEY

3) (Опційно) пропиши:
   - $serviceUrl (callback від WayForPay)
   - $returnUrl (куди повернути клієнта після оплати)

Офіційна документація WayForPay (Purchase + правила підпису):
https://wiki.wayforpay.com/en/view/852102


ПІДКЛЮЧЕННЯ ОПЛАТИ:
- Для реального запуску потрібно мати мерчант-акаунт WayForPay.
- Підпис (merchantSignature) робиться тільки на сервері (pay.php).


АЛЬТЕРНАТИВА (простий редірект):
- Якщо WayForPay дав тобі готове пряме посилання на оплату (invoice/checkout URL),
  встав його в index.html у змінну DIRECT_PAY_URL.
- Якщо DIRECT_PAY_URL порожній — використовується pay.php (підпис на сервері).


ЗБІР ДАНИХ (опційно):
- Можеш налаштувати LEAD_ENDPOINT (Google Apps Script), щоб заявки йшли в Google Sheets + Telegram.
