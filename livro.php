<?php
// livro.php - Guia interativo sobre Git e GitHub para alunos.

$pageTitle = 'Livro de Git e GitHub - IA Teste';
require __DIR__ . '/includes/header.php';
?>

<section class="hero">
  <div class="hero-content">
    <h1>📖 Livro de Git e GitHub</h1>
    <p>Um guia completo e prático para iniciantes sobre controlo de versões, Git e GitHub. Aprende os conceitos fundamentais e coloca as mãos na massa!</p>
  </div>
</section>

<!-- INTRODUÇÃO -->
<section class="card">
  <h2>🎯 Introdução</h2>
  <p>Git e GitHub são ferramentas essenciais para qualquer programador. Se queres trabalhar em equipa, guardar histórico do teu código, ou colaborar em projetos, <strong>precisas de Git</strong>.</p>
  <p>Neste livro vais aprender de forma simples e prática o que são, como funcionam e como usar no dia a dia.</p>
</section>

<!-- SEÇÃO 1: O QUE É GIT -->
<section class="card book-section">
  <h2>🔧 O que é Git?</h2>
  <p><strong>Git é um sistema de controlo de versões.</strong></p>
  <p>Imagina que estás a escrever um trabalho de escola. Enquanto escreves, queres guardar versões diferentes: <em>"versão v1", "versão melhorada", "versão final"</em>.</p>
  <p>Git faz exatamente isso com código! Guarda cada alteração que fazes, permitindo-te:</p>
  <ul class="feature-list">
    <li>Guardar histórico completo do código</li>
    <li>Voltar a versões anteriores se cometeres erro</li>
    <li>Trabalhar em vários ramos (branches) simultaneamente</li>
    <li>Colaborar com outras pessoas</li>
    <li>Ver quem alterou o quê e quando</li>
  </ul>
  <p class="note">💡 Git funciona no teu computador. É uma ferramenta local.</p>
</section>

<!-- SEÇÃO 2: O QUE É GITHUB -->
<section class="card book-section">
  <h2>☁️ O que é GitHub?</h2>
  <p><strong>GitHub é um servidor na internet que guarda repositórios Git.</strong></p>
  <p>Se Git é como uma pasta com histórico no teu computador, GitHub é como um cofre na nuvem onde podes:</p>
  <ul class="feature-list">
    <li>Guardar o teu código de forma segura na internet</li>
    <li>Partilhar código com colegas</li>
    <li>Colaborar com pessoas de qualquer lugar do mundo</li>
    <li>Criar um portfólio público dos teus projetos</li>
    <li>Ver repositórios de outras pessoas e aprender com eles</li>
  </ul>
  <p class="note">💡 GitHub é a plataforma mais popular para isto, mas existem alternativas (GitLab, Gitea, etc).</p>
</section>

<!-- SEÇÃO 3: DIFERENÇA -->
<section class="card book-section">
  <h2>⚖️ Git VS GitHub - Qual é a diferença?</h2>
  <table class="comparison-table">
    <tr>
      <th>Git</th>
      <th>GitHub</th>
    </tr>
    <tr>
      <td>Ferramenta de controlo de versões</td>
      <td>Plataforma para hospedar repositórios</td>
    </tr>
    <tr>
      <td>Funciona no teu computador</td>
      <td>Funciona na internet</td>
    </tr>
    <tr>
      <td>Linha de comando ou software gráfico</td>
      <td>Website com interface visual</td>
    </tr>
    <tr>
      <td>Necessário para programar localmente</td>
      <td>Opcional, é um bonus para colaboração</td>
    </tr>
    <tr>
      <td>Podes usar sem GitHub</td>
      <td>Depende de Git para funcionar</td>
    </tr>
  </table>
  <p class="note">💡 <strong>TL;DR</strong>: Git é a ferramenta, GitHub é o servidor. Um sem o outro não faz muito sentido para trabalho em equipa.</p>
</section>

<!-- SEÇÃO 4: REPOSITÓRIO -->
<section class="card book-section">
  <h2>📁 O que é um Repositório?</h2>
  <p><strong>Um repositório (ou "repo") é uma pasta especial que Git controla.</strong></p>
  <p>Podes pensar num repositório como um projeto completo. Dentro dele, estão:</p>
  <ul class="feature-list">
    <li>Todos os ficheiros do teu projeto (código, imagens, documentos)</li>
    <li>Um histórico completo de todas as alterações</li>
    <li>Informações sobre quem fez cada alteração</li>
    <li>Ramos (branches) para diferentes linhas de trabalho</li>
  </ul>
  <p>Quando dizes "push para o repositório" ou "clone o repositório", estás a falar da pasta inteira com todo o histórico.</p>
  <p class="note">💡 GitHub chama-se assim porque é um "hub" (central) de repositórios Git.</p>
</section>

<!-- SEÇÃO 5: COMMIT -->
<section class="card book-section">
  <h2>📸 O que é um Commit?</h2>
  <p><strong>Um commit é uma "fotografia" das tuas alterações num momento específico.</strong></p>
  <p>Imagina que estás a escrever código:</p>
  <ol>
    <li>Fazes algumas alterações no código</li>
    <li>As alterações estão no teu computador, mas não estão "guardadas" ainda no histórico</li>
    <li>Fazes um <strong>commit</strong> - isto cria uma fotografia daquele estado do código</li>
    <li>Essa fotografia tem uma mensagem explicativa (ex: "Corrigida função de login")</li>
    <li>Git guarda essa fotografia para sempre no histórico</li>
  </ol>
  <p>Cada commit tem:</p>
  <ul class="feature-list">
    <li>Um ID único (hash)</li>
    <li>Uma mensagem descritiva</li>
    <li>Informações sobre quem fez (nome e email)</li>
    <li>Data e hora exata</li>
    <li>Referência ao commit anterior</li>
  </ul>
  <p class="note">💡 Commits são como pontos de salvaguarda. Se algo correr mal, podes voltar a um commit anterior.</p>
</section>

<!-- SEÇÃO 6: BRANCH -->
<section class="card book-section">
  <h2>🌿 O que é uma Branch?</h2>
  <p><strong>Uma branch é uma "linha separada de trabalho" dentro do repositório.</strong></p>
  <p>Por padrão, toda a gente trabalha na branch chamada <code>main</code> (ou antigamente <code>master</code>).</p>
  <p>Mas podes criar novas branches para:</p>
  <ul class="feature-list">
    <li>Experimentar ideias sem estragar a branch principal</li>
    <li>Trabalhar em funcionalidades separadas</li>
    <li>Que vários programadores trabalhem simultaneamente sem conflitos</li>
    <li>Ter um sistema de revisão antes de juntar o código ("pull requests")</li>
  </ul>
  <p><strong>Exemplo:</strong> Tu crias a branch "nova-funcionalidade", trabalhas lá, depois juntas à main quando está pronto.</p>
  <p class="note">💡 Branches não são cópias - são apenas "apontadores" para um estado diferente do código. São muito leves e rápidas!</p>
</section>

<!-- SEÇÃO 7: PUSH & PULL -->
<section class="card book-section">
  <h2>⬆️⬇️ Push e Pull</h2>
  
  <h3>📤 Push - Enviar para o GitHub</h3>
  <p><strong>Push significa "empurrar" o teu código para o GitHub.</strong></p>
  <p>Quando fazes commits no teu computador, eles estão localmente. Para os enviares para o GitHub (e que toda a gente os veja), fazes um <strong>push</strong>.</p>
  <ul class="feature-list">
    <li>Push envia os teus commits para o repositório remoto (GitHub)</li>
    <li>Os teus colegas conseguem depois fazer pull para receber essas alterações</li>
    <li>Cria um backup automático do teu código</li>
  </ul>

  <h3>📥 Pull - Receber do GitHub</h3>
  <p><strong>Pull significa "puxar" as alterações do GitHub para o teu computador.</strong></p>
  <p>Quando os teus colegas fazem push com alterações, o teu código local fica desatualizado. Para trazer as novas alterações, fazes um <strong>pull</strong>.</p>
  <ul class="feature-list">
    <li>Pull descarrega os commits mais recentes do GitHub</li>
    <li>Atualiza o teu código com as alterações que faltam</li>
    <li>Permite que toda a equipa esteja sempre com o código mais recente</li>
  </ul>

  <p class="note">💡 <strong>Fluxo típico:</strong> Pull (para estar atualizado) → Fazer alterações → Commit → Push (para partilhar)</p>
</section>

<!-- SEÇÃO PRÁTICA: COMANDOS -->
<section class="card book-section">
  <h2>⌨️ Secção Prática - Comandos Essenciais</h2>
  
  <p>Agora vamos aos comandos reais que usas no terminal (Command Prompt, PowerShell, ou Bash).</p>

  <h3>1️⃣ Ver em que branch estás</h3>
  <div class="code-block">
    <code>git branch</code>
  </div>
  <p>Mostra a lista de branches locais. A branch atual tem um asterisco (<code>*</code>) à sua frente.</p>

  <h3>2️⃣ Mudar de branch</h3>
  <div class="code-block">
    <code>git switch main</code>
  </div>
  <p>Muda para a branch <code>main</code>. (Nota: <code>git checkout main</code> também funciona, mas <code>git switch</code> é mais comum agora)</p>

  <h3>3️⃣ Trazer alterações do GitHub</h3>
  <div class="code-block">
    <code>git pull</code>
  </div>
  <p>Descarrega e aplica as alterações mais recentes do repositório remoto (GitHub).</p>

  <h3>4️⃣ Preparar ficheiros para commit (stage)</h3>
  <div class="code-block">
    <code>git add .</code>
  </div>
  <p>Adiciona <strong>todos</strong> os ficheiros alterados para o "staging area" (a área de espera antes do commit).</p>
  <p class="note">💡 Alternativas: <code>git add ficheiro.php</code> (um ficheiro específico) ou <code>git add *.js</code> (todos os .js)</p>

  <h3>5️⃣ Guardar alterações (commit)</h3>
  <div class="code-block">
    <code>git commit -m "Descrição clara da alteração"</code>
  </div>
  <p>Cria um commit com a mensagem descritiva. A mensagem deve ser clara e breve.</p>
  <p class="note">💡 Exemplo bom: <code>git commit -m "Corrigida validação de email no formulário de registo"</code></p>

  <h3>6️⃣ Enviar para GitHub (push)</h3>
  <div class="code-block">
    <code>git push</code>
  </div>
  <p>Envia os teus commits para o GitHub. Agora toda a equipa consegue fazer pull para receber as alterações.</p>

  <h3>🔄 O fluxo completo (exemplo)</h3>
  <div class="workflow-box">
    <p><strong>1.</strong> Começa o dia:</p>
    <div class="code-block"><code>git pull</code></div>
    
    <p><strong>2.</strong> Trabalhas no teu código...</p>
    
    <p><strong>3.</strong> Quando terminaste uma funcionalidade:</p>
    <div class="code-block"><code>git add .</code></div>
    <div class="code-block"><code>git commit -m "Adicionada funcionalidade de perfil de utilizador"</code></div>
    <div class="code-block"><code>git push</code></div>
    
    <p><strong>4.</strong> Pronto! Os teus colegas conseguem agora fazer pull para ver as tuas alterações.</p>
  </div>
</section>

<!-- RESUMO RÁPIDO -->
<section class="card summary-card">
  <h2>✨ Resumo Rápido</h2>
  
  <div class="summary-grid">
    <div class="summary-item">
      <div class="summary-term">🔧 Git</div>
      <p>Sistema de controlo de versões. Funciona no teu PC.</p>
    </div>
    
    <div class="summary-item">
      <div class="summary-term">☁️ GitHub</div>
      <p>Servidor na internet para hospedar repositórios Git.</p>
    </div>
    
    <div class="summary-item">
      <div class="summary-term">📁 Repositório</div>
      <p>Pasta com histórico completo de alterações controlado por Git.</p>
    </div>
    
    <div class="summary-item">
      <div class="summary-term">📸 Commit</div>
      <p>Uma "fotografia" das alterações. Tem mensagem, autor, data.</p>
    </div>
    
    <div class="summary-item">
      <div class="summary-term">🌿 Branch</div>
      <p>Linha separada de trabalho. Permite trabalho paralelo.</p>
    </div>
    
    <div class="summary-item">
      <div class="summary-term">⬇️ Pull</div>
      <p>Descarregar e aplicar alterações do GitHub no teu PC.</p>
    </div>
    
    <div class="summary-item">
      <div class="summary-term">⬆️ Push</div>
      <p>Enviar os teus commits para o GitHub.</p>
    </div>
    
    <div class="summary-item">
      <div class="summary-term">⌨️ Comando</div>
      <p>Instruções que dás ao Git no terminal.</p>
    </div>
  </div>
</section>

<!-- DICAS FINAIS -->
<section class="card">
  <h2>💡 Dicas Finais</h2>
  
  <h3>✅ Boas práticas</h3>
  <ul class="feature-list">
    <li><strong>Commits pequenos e frequentes:</strong> Vários commits simples são melhores que um grande commit</li>
    <li><strong>Mensagens claras:</strong> Escreve mensagens que expliquem <em>o quê</em> e <em>porquê</em>, não apenas <em>o quê</em></li>
    <li><strong>Pull antes de trabalhar:</strong> Sempre começa com <code>git pull</code> para ter o código mais recente</li>
    <li><strong>Trabalha em branches separadas:</strong> Não mexas diretamente na <code>main</code>, cria uma branch para cada funcionalidade</li>
    <li><strong>Faz backup regularmente:</strong> Push regularmente para não perder trabalho</li>
  </ul>

  <h3>⚠️ Erros comuns</h3>
  <ul class="feature-list">
    <li><strong>Esquecer de fazer pull:</strong> Resultados em conflitos quando outra pessoa alterou o mesmo ficheiro</li>
    <li><strong>Commits sem mensagem clara:</strong> Difícil entender o que mudou meses depois</li>
    <li><strong>Guardar ficheiros grandes:</strong> Git não é bom para ficheiros enormes (vídeos, mega-imagens)</li>
    <li><strong>Nunca fazer push na main diretamente:</strong> Em projetos reais, usa pull requests para revisão</li>
  </ul>
</section>

<!-- PRÓXIMOS PASSOS -->
<section class="card">
  <h2>🚀 Próximos Passos</h2>
  
  <ol>
    <li><strong>Instala Git:</strong> Vai a <code>git-scm.com</code> e descarrega a última versão</li>
    <li><strong>Cria conta no GitHub:</strong> Vai a <code>github.com</code> e regista-te gratuitamente</li>
    <li><strong>Cria o teu primeiro repositório:</strong> No GitHub, clica em "New" e segue os passos</li>
    <li><strong>Faz clone na tua máquina:</strong> <code>git clone URL_do_repositório</code></li>
    <li><strong>Pratica os comandos:</strong> Cria ficheiros, faz commits, push e pull</li>
    <li><strong>Colabora:</strong> Convida um amigo para colaborar no repositório</li>
    <li><strong>Aprende mais:</strong> Quando dominas isto, podes aprender sobre Pull Requests, merge conflicts, rebase, etc.</li>
  </ol>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
