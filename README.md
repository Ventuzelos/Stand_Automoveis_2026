# 🚗 UrbanMotors

Sistema de gestão e catálogo de viaturas desenvolvido em Laravel para a gestão de um stand automóvel.

O projeto inclui uma área interna (B2B) para administração do negócio e uma área pública (B2C) para consulta do catálogo de viaturas.

---

## 📋 Funcionalidades

### Área Administrativa (B2B)

- Dashboard com indicadores de negócio
- Gestão de Clientes (CRUD)
- Gestão de Viaturas (CRUD)
- Gestão de Vendas (CRUD)
- Gestão de Utilizadores
- Sistema de permissões por função
- Auditoria de ações dos utilizadores
- Exportação de dados para CSV
- Pesquisa, filtros e paginação

### Área Pública (B2C)

- Página inicial
- Catálogo de viaturas
- Página de detalhe da viatura
- Página Sobre Nós
- Página FAQ
- Página de Contactos
- Design responsivo para desktop, tablet e mobile

---

## 🛠 Tecnologias Utilizadas

### Back-End

- PHP 8
- Laravel 12
- Eloquent ORM

### Front-End

- Blade
- HTML5
- CSS3
- Bootstrap 5
- JavaScript

### Base de Dados

- MySQL

### Ferramentas

- Laravel Breeze
- Vite
- Git
- GitHub

---

## 📊 Principais Funcionalidades

### Dashboard

- Total de clientes
- Total de viaturas
- Total de vendas
- Viaturas disponíveis e vendidas
- Faturação total
- Estatísticas mensais
- Gráficos de apoio à gestão

### Auditoria

Registo automático de:

- Criação de registos
- Edição de registos
- Eliminação de registos

---

## 🗄 Estrutura da Base de Dados

Principais entidades:

- Users
- Clientes
- Viaturas
- Vendas
- Activity Logs

A estrutura da base de dados foi criada através de **Laravel Migrations**.

---

## 🌱 Seeders

O projeto inclui seeders para gerar dados de demonstração:

- Utilizador Administrador
- Utilizador Vendedor
- Clientes de exemplo
- Viaturas de exemplo
- Vendas de exemplo

---

## 🚀 Instalação

### Clonar o repositório

```bash
git clone https://github.com/Ventuzelos/Stand_Automoveis_2026.git
```

### Entrar na pasta

```bash
cd Stand_Automoveis_2026
```

### Instalar dependências PHP

```bash
composer install
```

### Instalar dependências JavaScript

```bash
npm install
```

### Configurar ambiente

```bash
cp .env.example .env
```

Gerar chave:

```bash
php artisan key:generate
```

### Configurar base de dados

Atualizar as credenciais no ficheiro `.env`.

Executar:

```bash
php artisan migrate --seed
```

### Criar link para armazenamento

```bash
php artisan storage:link
```

### Compilar assets

```bash
npm run build
```

### Iniciar servidor

```bash
php artisan serve
```

---

## 👥 Perfis de Utilizador

### Administrador

- Gestão total do sistema
- Gestão de utilizadores
- Auditoria
- Exportação

### Vendedor

- Gestão de clientes
- Gestão de viaturas
- Gestão de vendas

---

## 📱 Responsividade

A interface foi desenvolvida utilizando Bootstrap 5 e CSS personalizado, garantindo compatibilidade com:

- Desktop
- Tablet
- Smartphone

---

## 🎓 Contexto Académico

Projeto desenvolvido no âmbito da formação **Software Developer** do **CESAE Digital**, aplicando conhecimentos de:

- Desenvolvimento Web
- Bases de Dados
- Laravel
- PHP
- Bootstrap
- JavaScript
- Git e GitHub

---

## 👩‍💻 Autora

**Ângela Pereira**

- GitHub: https://github.com/Ventuzelos
- Portfolio: https://angelapereira.vercel.app
- LinkedIn: https://www.linkedin.com/in/angelaventuzelospereira/
