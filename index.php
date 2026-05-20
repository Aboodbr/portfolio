<?php
$host = 'localhost';
$user = 'root'; 
$pass = '';
$dbname = 'portfolio_db';

$conn = new mysqli($host, $user, $pass, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Abood Albetar | Backend Developer</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500&family=Poppins:wght@300;400;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="mobile-nav-toggle">
      <i class="fas fa-bars"></i>
    </div>

    <aside class="sidebar">
      <div class="profile">
        <img src="pic.jpg" alt="Abood Albetar" />
        <h1 class="logo">Abood</h1>
        <span class="role">Backend Developer</span>
      </div>

      <nav class="nav-menu">
        <ul>
          <li>
            <a href="#home" class="active"
              ><i class="fas fa-home"></i> <span>Home</span></a
            >
          </li>
          <li>
            <a href="#projects"
              ><i class="fas fa-code"></i> <span>Projects</span></a
            >
          </li>
          <li>
            <a href="#skills"
              ><i class="fas fa-laptop-code"></i>
              <span>Technical Skills</span></a
            >
          </li>
          <li>
            <a href="#contact"
              ><i class="fas fa-envelope"></i> <span>Contact</span></a
            >
          </li>
        </ul>
      </nav>

      <div class="sidebar-footer">
        <div class="social-links">
          <a href="https://github.com/Aboodbr" target="_blank"
            ><i class="fab fa-github"></i
          ></a>
          <a
            href="https://www.linkedin.com/in/abdelrahman-albetar-672375318/"
            target="_blank"
            ><i class="fab fa-linkedin-in"></i
          ></a>
          <a href="https://wa.me/01123759832" target="_blank"
            ><i class="fab fa-whatsapp"></i
          ></a>
        </div>
        <p>&copy; 2026 Abood Albetar</p>
      </div>
    </aside>

    <main class="main-content">
      <section id="home" class="section">
        <div class="home-container">
          <p class="greeting">Hi, my name is</p>
          <h1 class="name">Abood Albetar.</h1>
          <h2 class="subtitle">
            I build robust <span class="highlight typed-text"></span>
          </h2>
          <p class="description">
            Backend Developer specializing in PHP/Laravel, MySQL, and RESTful
            APIs. Experienced in engineering scalable enterprise solutions,
            including complex ERP systems with role-based access controls.
            Passionate about delivering secure, high-performance applications
            through clean, optimized code.
          </p>
          <div class="home-btns">
            <a href="#projects" class="btn btn-primary">Check out my work</a>
            <a
              href="https://drive.google.com/file/d/1zhuc8GDrG6Nhx0fk3wpeNgD2n6arQSAe/view?usp=sharing"
              target="_blank"
              class="btn btn-outline"
              >Download CV</a
            >
          </div>
        </div>
      </section>

      <section id="projects" class="section">
        <h2 class="section-title">Some Things I've Built</h2>
        <div class="projects-grid">
          
          <?php
          // جلب المشاريع من قاعدة البيانات وعرضها ديناميكياً
          $result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
          
          if ($result && $result->num_rows > 0):
              while($row = $result->fetch_assoc()): 
          ?>
          <div class="project-card hidden">
            <div class="project-img">
              <!-- عرض الصورة من مجلد uploads -->
              <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>" loading="lazy" />
            </div>
            <div class="project-content">
              <span class="project-category"><?= htmlspecialchars($row['category']) ?></span>
              <h3 class="project-title"><?= htmlspecialchars($row['title']) ?></h3>
              <div class="project-links">
                <?php if(!empty($row['github_link'])): ?>
                <a
                  href="<?= htmlspecialchars($row['github_link']) ?>"
                  target="_blank"
                  style="margin-right: 10px"
                  ><i class="fab fa-github"></i> GitHub</a
                >
                <?php endif; ?>
                
                <?php if(!empty($row['demo_link'])): ?>
                <a
                  href="<?= htmlspecialchars($row['demo_link']) ?>"
                  target="_blank"
                  ><i class="fas fa-external-link-alt"></i> Demo</a
                >
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php 
              endwhile; 
          else:
              echo "<p style='color: var(--text-slate);'>No projects have been added yet.</p>";
          endif; 
          ?>

        </div>
      </section>

      <section id="skills" class="section">
        <h2 class="section-title">Technical Skills</h2>
        <div class="skills-category-container">
          <div class="skill-category-card hidden">
            <div class="card-header">
              <i class="fas fa-code"></i>
              <h3>Languages</h3>
            </div>
            <div class="skill-tags">
              <span class="tag"><i class="fab fa-php"></i> PHP</span>
              <span class="tag"><i class="fas fa-database"></i> SQL</span>
              <span class="tag"><i class="fab fa-js"></i> JavaScript</span>
              <span class="tag"><i class="fas fa-file-code"></i> C++</span>
              <span class="tag"><i class="fab fa-html5"></i> HTML</span>
              <span class="tag"><i class="fab fa-css3-alt"></i> CSS</span>
            </div>
          </div>

          <div class="skill-category-card hidden">
            <div class="card-header">
              <i class="fas fa-layer-group"></i>
              <h3>Frameworks & Libraries</h3>
            </div>
            <div class="skill-tags">
              <span class="tag"><i class="fab fa-laravel"></i> Laravel</span>
              <span class="tag"><i class="fas fa-box"></i> Filament</span>
              <span class="tag"
                ><i class="fab fa-bootstrap"></i> Bootstrap 5</span
              >
              <span class="tag"><i class="fas fa-sync-alt"></i> AJAX</span>
              <span class="tag"
                ><i class="fas fa-exclamation-circle"></i> SweetAlert</span
              >
            </div>
          </div>

          <div class="skill-category-card hidden">
            <div class="card-header">
              <i class="fas fa-server"></i>
              <h3>Databases & Tools</h3>
            </div>
            <div class="skill-tags">
              <span class="tag"><i class="fas fa-database"></i> MySQL</span>
              <span class="tag"><i class="fab fa-git-alt"></i> Git</span>
              <span class="tag"
                ><i class="fas fa-space-shuttle"></i> Postman</span
              >
              <span class="tag"><i class="fas fa-fire"></i> Firebase</span>
              <span class="tag"
                ><i class="fas fa-file-excel"></i> Adv. Excel & Sheets</span
              >
            </div>
          </div>

          <div class="skill-category-card hidden">
            <div class="card-header">
              <i class="fas fa-lightbulb"></i>
              <h3>Core Concepts</h3>
            </div>
            <div class="skill-tags">
              <span class="tag"><i class="fas fa-cubes"></i> OOP</span>
              <span class="tag"
                ><i class="fas fa-check-double"></i> SOLID Principles</span
              >
              <span class="tag"
                ><i class="fas fa-network-wired"></i> RESTful APIs</span
              >
              <span class="tag"
                ><i class="fas fa-project-diagram"></i> DB Design &
                Transactions</span
              >
              <span class="tag"
                ><i class="fas fa-bolt"></i> Query Optimization</span
              >
              <span class="tag"><i class="fas fa-user-shield"></i> RBAC</span>
            </div>
          </div>
        </div>
      </section>

      <section id="contact" class="section">
        <h2 class="section-title">Get In Touch</h2>
        <div class="contact-wrapper">
          <div class="contact-info hidden">
            <div class="info-box">
              <i class="fas fa-map-marker-alt"></i>
              <div>
                <h4>Location</h4>
                <p>Egypt Sharkia, 10th of Ramadan</p>
              </div>
            </div>
            <div class="info-box">
              <i class="fas fa-envelope"></i>
              <div style="width: 100%; overflow: hidden">
                <h4>Email</h4>
                <p style="word-break: break-word; overflow-wrap: anywhere">
                  aboodragon12345@gmail.com
                </p>
              </div>
            </div>
            <div class="info-box">
              <i class="fas fa-phone"></i>
              <div>
                <h4>Call Me</h4>
                <p>+20 1123759832</p>
              </div>
            </div>
          </div>

          <form class="contact-form hidden">
            <div class="input-row">
              <input type="text" placeholder="Your Name" required />
              <input type="email" placeholder="Your Email" required />
            </div>
            <input type="text" placeholder="Subject" required />
            <textarea placeholder="Message" required></textarea>
            <button type="submit" class="btn btn-primary">
              Send Message <i class="fas fa-paper-plane"></i>
            </button>
          </form>
        </div>
      </section>
    </main>

    <script src="script.js"></script>
  </body>
</html>