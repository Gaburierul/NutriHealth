# 🍏 NutriHealth

**NutriHealth** é um sistema web desenvolvido como Trabalho de Conclusão de Curso (TCC) do curso de Informática para Internet. O objetivo da plataforma é conectar e facilitar o acompanhamento de saúde dos usuários, integrando módulos dedicados tanto para **Nutricionistas** quanto para **Personal Trainers**.

## 🚀 Funcionalidades

- **Página Inicial (Landing Page):** Apresentação do projeto, serviços oferecidos e informações sobre a plataforma.
- **Sistema de Autenticação:** Cadastro e login de usuários processados no backend.
- **Módulo Nutricionista:** Interface dedicada para profissionais de nutrição, focado no acompanhamento de dietas e pacientes.
- **Módulo Personal Trainer:** Interface para profissionais de educação física, com calendário integrado para gestão de treinos.
- **Interface Responsiva:** Estilização desenvolvida com CSS puro (Vanilla CSS), garantindo fluidez em diferentes tamanhos de tela.

## 🛠️ Tecnologias Utilizadas

O projeto foi construído utilizando as tecnologias fundamentais da web, sem a dependência de frameworks pesados:

- **Frontend:** HTML5, CSS3 e JavaScript Vanilla.
- **Backend:** PHP (processamento de regras de negócio, sessões e comunicação com o banco).
- **Banco de Dados:** MySQL (script de criação incluso em conexaoBD/nutrihealthb01.sql).
- **Ícones:** Bootstrap Icons.

## 📂 Estrutura do Projeto

* `pag-menu/`: Arquivos da Landing Page principal (Sobre, Serviços e Login).
* `pag-nutricionista/`: Telas e lógicas do painel exclusivo para nutricionistas.
* `pag-personal/`: Telas, calendário e gerenciamento de perfil para Personal Trainers.
* `conexaoBD/`: Arquivos de configuração do Banco de Dados e os scripts de processamento em PHP.
* `src/`: Assets estruturais, imagens de fundo e logotipos.

## ⚙️ Como Executar Localmente

1. Clone este repositório em sua máquina: git clone https://github.com/Gaburierul/NutriHealth.git
2. Instale um servidor web local com suporte a PHP e MySQL (ex: XAMPP, WAMP ou Laragon).
3. Mova a pasta do projeto para o diretório público do servidor (ex: htdocs no XAMPP).
4. Inicie os serviços do Apache e do MySQL.
5. Acesse o phpMyAdmin, crie um banco de dados vazio e importe o arquivo `conexaoBD/nutrihealthb01.sql`.
6. Caso a senha do seu banco de dados local seja diferente, ajuste as credenciais no arquivo `conexaoBD/conexao.php`.
7. Acesse no navegador a rota local correspondente ao arquivo `pag-menu/home.html`.

## 👨‍💻 Autor

- **Gabriel** (@Gaburierul)
- **João Jacob**
- **Victor Hugo Manzano**
- **Marcelino**
