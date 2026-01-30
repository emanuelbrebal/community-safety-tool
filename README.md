# 🛡️ ComunidadeAlerta

> Plataforma de Segurança Comunitária focada no monitoramento urbano colaborativo. Permite que moradores realizem denúncias anônimas e auditáveis, fortalecendo a rede de proteção local através da tecnologia.

### 💻 Sobre o Projeto

A insegurança em bairros residenciais muitas vezes é agravada pela falta de comunicação e pelo medo de represálias ao denunciar. O **ComunidadeAlerta** surgiu como um projeto universitário para resolver esse problema, criando um canal seguro e **totalmente anônimo** para registro de incidentes.

Diferente de grupos de WhatsApp desorganizados, a plataforma estrutura os dados, permitindo que líderes comunitários ou autoridades visualizem manchas criminais e incidentes recorrentes, transformando relatos individuais em inteligência de segurança.

---

### 🛠 Tecnologias Utilizadas

O sistema foi construído sobre uma arquitetura robusta de Monólito Moderno (SPA):

- **Back-end:** PHP 8.2, Laravel 10 (foco em segurança e validação de dados).
- **Front-end:** Vue.js 3, Inertia.js (SPA sem complexidade de API separada).
- **UI Framework:** Bootstrap 5 (para interfaces rápidas e responsivas).
- **Banco de Dados:** PostgreSQL.
- **Outros:** Docker, Vite.

---

### ✨ Funcionalidades (Use Cases)

- [x] **Denúncia Anônima Segura:** O core do sistema. Permite registrar ocorrências (furto, atividade suspeita, iluminação pública falha) sem vincular dados sensíveis do usuário à visualização pública.
- [x] **Feed de Incidentes:** Visualização em lista das ocorrências recentes para que a comunidade esteja ciente do que acontece ao redor.
- [x] **Painel Administrativo Auditável:** Moderadores podem visualizar detalhes técnicos das denúncias para validação, mantendo o sigilo do denunciante.
- [x] **Categorização de Ocorrências:** Filtros por tipo de incidente (Segurança, Infraestrutura, Emergência).
- [x] **Cadastro completo de perfis de usuário:** Usuários devem se cadastrar e preencher um perfil de moradia, obrigatório para fazer parte ativa do sistema, concordando com termos da LGPD e servindo de auxílio para os agentes de segurança pública.
- [x] **Rede social no estilo fórum**: Sistema tem o conjunto básico da rede social: Publicações, comentários e "likes" que aumentam o engajamento e, por consequência, a prioridade de resolução do incidente registrado.
- [ ] **Chat em tempo real via WebSocket**: Estudando a possibilidade de implementação de WebSocket para a inclusão de notificações e um chat em tempo real para melhor comunicação.
- [ ] **Notificações e e-mails**: Módulo de e-mails para notificar usuários e administradores sobre a movimentação das publicações (aprovada, publicada, resolvida).

---

### 🧠 O que eu aprendi

1. **Privacidade por Design:** O desafio de arquitetar um banco de dados que permita a auditoria da denúncia (para evitar spam/fake news) sem comprometer o anonimato real do usuário. E também garantir que cada usuário e administrador só interaja dentro da sua própria comunidade mapeada no sistema (comunidade esta que é selecionada no cadastro).
2. **Integração Vue + Bootstrap:** Como utilizar componentes modernos do Vue dentro do grid system clássico do Bootstrap de forma eficiente.
3. **SPA com Inertia:** Aprofundei o uso do Inertia.js para criar uma experiência de navegação fluida (sem reload) mantendo o routing no Laravel.

---

### 🚀 Roadmap e Melhorias (Estudo de Viabilidade)

O projeto tem um roadmap ambicioso para se tornar uma ferramenta de *Real-time Response*:

- [ ] **Geolocalização (Google Maps API):** Plotar as denúncias em um mapa de calor (Heatmap) para identificar zonas de perigo.
- [ ] **WebSockets (Laravel Reverb/Pusher):** Notificar moradores em tempo real quando uma ocorrência grave for registrada num raio de 1km.
- [ ] **App Mobile:** Versão nativa para facilitar o envio de fotos e localização GPS precisa.
- [ ] **Gerar relatórios no estilo BO:** O sistema deve gerar um relatório completo no estilo do boletim de ocorrência para que facilite as ações dos agentes de segurança pública.
 
---

### 📦 Como rodar o projeto

Este projeto utiliza **Laravel** com **Docker** (Laravel Sail).

```bash
# 1. Clone o repositório
$git clone [https://github.com/emanuelbrebal/comunidade-alerta.git$](https://github.com/emanuelbrebal/comunidade-alerta.git$) cd comunidade-alerta

# 2. Instale as dependências
$ composer install
$ npm install

# 3. Configure o ambiente
$ cp .env.example .env
# Configure as credenciais do banco no .env

# 4. Gere a chave da aplicação
$ php artisan key:generate

# 5. Suba o ambiente (Via Docker/Sail)
$ ./vendor/bin/sail up -d

# 6. Execute as migrações
$ ./vendor/bin/sail artisan migrate --seed

# 7. Compile os assets (Bootstrap/Vue)
$ npm run dev
