 <nav class="navbar navbar-expand bg-success-subtle px-5">
   <div class="container-fluid">
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse justify-content-between" id="navbarText">
       <ul class="navbar-nav mb-2 mb-lg-0">
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="/wsms/pages/home.php">الرئيسية</a>
         </li>
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="/wsms/pages/schedules.php?page=schedules_list">الجداول</a>
         </li>
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="/wsms/pages/classes.php?page=classes_list">الصفوف</a>
         </li>
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="/wsms/pages/materials.php?page=materials_list">المواد</a>
         </li>
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="/wsms/pages/teachers.php?page=teachers_list">المدرسين</a>
         </li>
       </ul>
       <ul class="navbar-nav mb-2 mb-lg-0">
         <li class="nav-item">
           <a class="nav-link " href="./admin.php">واجهة الادمن</a>
         </li>
         <li class="nav-item">
           <a class="nav-link text-secondary" href="./user_profile.php"><?php echo htmlspecialchars($_SESSION["username"]); ?></a>
         </li>
         <li class="nav-item">
           <a class="nav-link text-danger" href="./users/user_logout.php">تسجيل الخروج > </a>
         </li>
       </ul>
     </div>
   </div>
 </nav>