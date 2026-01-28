# Діагностика, якщо рядки не з’являються в Google Таблиці

## 1) Ping (має бути без логіну!)
Відкрий у браузері (краще в інкогніто):
https://script.google.com/macros/s/AKfycbw2tIagCoaaz7J9U38heho_9AMgCNTT4gq2ByqW24QG4dWBW94plc8hl5OYxgbGgFPhBg/exec?ping=1

Очікувано: `OK: ping`
Якщо просить увійти або помилка → в деплої НЕ стоїть "Anyone".

## 2) Тестовий запис (також у браузері)
Відкрий:
https://script.google.com/macros/s/AKfycbw2tIagCoaaz7J9U38heho_9AMgCNTT4gq2ByqW24QG4dWBW94plc8hl5OYxgbGgFPhBg/exec?email=test@example.com&phone=%2B380%20(67)%20123-45-67

Очікувано: `OK: row_added`
Після цього в таблиці з’явиться лист Leads і рядок.

## 3) Онови деплой після змін коду
Apps Script → Deploy → Manage deployments → Edit → **Update**.
(Інакше Web App працює зі старою версією коду.)

## 4) Подивись Executions
Apps Script → Executions.
Якщо є ERR — відкрий деталі й надішли текст помилки.
