# Збір заявок тільки в Google Sheets

✅ **SHEET_ID вже підставлений у Code.gs:** `1sm8SzB5r0jUYEKJpn_qx2_l1WYZt-fVUdo3iNhUUnH4`

## Як підключити (без сервера)
1) Відкрий показаний у папці `google-apps-script/Code.gs` код у Google Apps Script:
   - або в самій таблиці: **Extensions → Apps Script**
   - або через script.new (і тоді відкрий таблицю по SHEET_ID)

2) Deploy → **New deployment** → **Web app**
   - Execute as: **Me**
   - Who has access: **Anyone**
   Після деплою скопіюй **Web app URL**.

3) У файлі `index.html` встав Web app URL у змінну:
```js
const LEAD_ENDPOINT = "ТУТ_WEB_APP_URL";
```

## Куди записуються дані
У твою таблицю на лист **Leads** (створиться автоматично, якщо його нема).

## Які поля пишуться
ts, email, phone, product, price, currency, country, page, utm_source, utm_medium, utm_campaign, utm_content, utm_term
