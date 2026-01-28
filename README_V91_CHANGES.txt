v91: mobile fix for bonus-card overflow
- .bonus-card width changed from min(720px, 100%) to min(720px, calc(100% - 28px))
  This prevents the bonus plaque from going outside the viewport when side margins are applied on mobile.
