# Api do Brasileirão
Esta é uma API que consulta estatisticas do Campeonato Brasileiro, exibindo a tabela de classificação, todos os jogos com resultados, dia e horário, e o ranking dos artilheiros. O Desenvolvimento foi feito em Laravel, tem uma documentação em Swagger e o consumo da API é da  [football-data.org](https://www.football-data.org/) .

## Requisitos
PHP 8.0 ou superior
Laravel
Composer
Swagger

## Documentação no Swagger
[Documentação da API](https://lucasbritto.com/football/api/documentation)


## Instalação BACKEND

1. Clone o repositório:
```bash    
    git clone https://github.com/lucaasbritto/Campeonato-back.git
```

2. Acesse o diretório do projeto:
    cd seu-repositorio

3. Configure o arquivo .env:
    Renomeie o arquivo .env.example para .env e configure as variáveis de ambiente conforme necessário,

4. Insira sua chave Token da API no arquivo .env: (esse token para gerar tem que se criar conta no site)
    FOOTBALL_API_KEY = 'seu_token'

5. Instale as dependencias do composer:
    Composer Install

6. Gere a chave de aplicativo do Laravel:
    php artisan key:generate

7. Inicie o servidor local:
    php artisan serve


## ENDPOINT DA API


### Buscar Cliente

- **URL:** `GET /teams`
- **Descrição:** Busca todos os times
- **Resposta:**    
    Todos os times que esteja participando do campeonato.


### Buscar Cliente
- **URL:** `GET /classification`
- **Descrição:** Busca a tabela atualizada
- **Resposta:**    
    Tabela atualizada do campeonato.


### Buscar Cliente
- **URL:** `GET /matches`
- **Descrição:** Busca todos os jogos por rodada
- **Resposta:**    
    Todos os jogos com resultado, dia e hora

### Buscar Cliente
- **URL:** `GET /topScorers`
- **Descrição:** Busca todos os artilheiros
- **Resposta:**    
    Exibe os maiores artilheiros e assistencia do campeonato

