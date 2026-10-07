# 🍏 NutriHealth

**NutriHealth** é um sistema web desenvolvido como Trabalho de Conclusão de Curso (TCC) do curso de Informática para Internet. O objetivo da plataforma é conectar e facilitar o acompanhamento de saúde dos usuários, integrando módulos dedicados tanto para **Nutricionistas** quanto para **Personal Trainers**.

## 🚀 Funcionalidades

- **Página Inicial (Landing Page):** Apresentação do projeto, serviços oferecidos e informações sobre a plataforma.
- **Sistema de Autenticação:** Cadastro e login de usuários processados no backend (`processa_registro.php` e `processa_login.php`).
- **Módulo Nutricionista:** Interface dedicada para profissionais de nutrição, focado no acompanhamento de dietas e pacientes.
- **Módulo Personal Trainer:** Interface para profissionais de educação física, com calendário integrado para gestão de treinos.
- **Interface Responsiva:** Estilização desenvolvida com CSS puro (Vanilla CSS), garantindo fluidez em diferentes tamanhos de tela.

## 🛠️ Tecnologias Utilizadas

O projeto foi construído utilizando as tecnologias fundamentais da web, sem a dependência de frameworks pesados:

- **Frontend:** HTML5, CSS3 e JavaScript Vanilla.
- **Backend:** PHP (processamento de regras de negócio, sessões e comunicação com o banco).
- **Banco de Dados:** MySQL (script de criação incluso em `conexaoBD/nutrihealthb01.sql`).
- **Ícones:** Bootstrap Icons.

## 📂 Estrutura do Projeto

* `pag-menu/`: Arquivos da Landing Page principal (Sobre, Serviços e Login).
* `pag-nutricionista/`: Telas e lógicas do painel exclusivo para nutricionistas.
* `pag-personal/`: Telas, calendário e gerenciamento de perfil para Personal Trainers.
* `conexaoBD/`: Arquivos de configuração do Banco de Dados (`conexao.php`) e os scripts de processamento em PHP.
* `src/`: Assets estruturais, imagens de fundo e logotipos.

## ⚙️ Como Executar Localmente

1. Clone este repositório em sua máquina:
   ```bash
   git clone https://github.com/Gaburierul/NutriHealth.git
