### Instalação

```
composer require ifc/cookiebar
```

### Configurar url da página da Politica de Privacidade

No arquivo .env insira a url da página com a política de privacidade do site


```
PAGINA_POLITICA_PRIVACIDADE="https://protecaodedados.ifc.edu.br/politica-de-privacidade"
```

### Botão para redefinir Cookies

Utilize a função **_redefinirCookies()** para abrir a janela de redefinição de cookies após eles já terem sido confirmados, exemplo:

```html
<button onclick="_redefinirCookies(); return false;">
    Redefinir Coookies
</button>
```

