<?php
namespace IFC\Cookiebar\Middleware;

use Closure;
class AppendFiles
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $response = $this->buildEssential($response);

        return $response;
    }

    public function buildEssential($response)
    {
        // Verifica se a resposta é uma resposta HTML
        if ($response->headers->get('Content-Type') === 'text/html; charset=UTF-8') {

            $importacoesCss = "    <!-- IFC Cookiebar --> \n" .
                "        <link rel=\"stylesheet\" type=\"text/css\" href=\"./css/cookiebar_govbr.css\" />\n" .
                "        <!-- Fim IFC Cookiebar--> \n   ";

            // inserir $importacoes antes de fechar a tag </head>
            $response->setContent(
                str_replace('</head>', $importacoesCss . '</head>', $response->getContent())
            );

            $divElement = "<div class=\"container_govbr\">\n" .
                "    <div class=\"redefinir-cookies\"></div>\n" .
                "    <div class=\"dsgov\">\n" .
                "        <div class=\"br-cookiebar default d-none\" tabindex=\"-1\">\n" .
                "            <div class=\"br-modal\">\n" .
                "                <div class=\"br-card\">\n" .
                "                    <div class=\"container\">\n" .
                "                        <div class=\"wrapper\">\n" .
                "                            <div class=\"br-modal-header entry-content\">\n" .
                "                                <div class=\"br-modal-title\"></div>\n" .
                "                                <div class=\"last-update\"></div>\n" .
                "                                <div class=\"entry-text\"></div>\n" .
                "                            </div>\n" .
                "                            <div class=\"br-modal-body\">\n" .
                "                                <div class=\"info-text\"></div>\n" .
                "                                <div class=\"br-list main-content\">\n" .
                "                                </div>\n" .
                "                            </div>\n" .
                "                        </div>\n" .
                "                        <div class=\"br-modal-footer actions\">\n" .
                "                            <button class=\"br-button small btn-manage\" type=\"button\" aria-label=\"Definir Cookies\"></button>\n" .
                "                            <button class=\"br-button secondary small reject-all\" type=\"button\" aria-label=\"Rejeitar\">Rejeitar</button>\n" .
                "                            <button class=\"br-button secondary small btn-accept\" type=\"button\" aria-label=\"Aceitar\"></button>\n" .
                "                        </div>\n" .
                "                    </div>\n" .
                "                </div>\n" .
                "            </div>\n" .
                "        </div>\n" .
                "    </div>\n" .
                "</div>";

            $response->setContent(
                str_replace('</body>', $divElement . '</body>', $response->getContent())
            );

            $importacoesJs = "    <!-- IFC Cookiebar --> \n" .
                "        <script type=\"text/javascript\"> \n".
                "           var url_politica_privacidade = \"" . env('PAGINA_POLITICA_PRIVACIDADE') . "\" \n".
                "        </script> \n".
                "        <script type=\"text/javascript\" src=\"./js/application_cookiebar_1_3_55.js\" ></script>\n" .
                "        <script type=\"text/javascript\" src=\"./js/block_cookies.js\" ></script>\n" .
                "        <script type=\"text/javascript\" src=\"./js/changeCookieImage.js\" ></script>\n" .
                "        <script type=\"text/javascript\" src=\"./js/cookiebar_1_3_55.js\" ></script>\n" .
                "        <script type=\"text/javascript\" src=\"./js/lgpd_cookie_handling_1_3_87.js\" ></script>\n" .
                "        <!-- Fim IFC Cookiebar--> \n   ";

            // inserir $importacoes antes de fechar a tag </body>
            $response->setContent(
                str_replace('</body>', $importacoesJs . '</body>', $response->getContent())
            );
        }
        return $response;
    }
}
