  
  <footer>
    <div class="footer">
      <div class="container">
        <div class="footer-urls">
          <a href="/hakkimizda">Hakkımızda</a>
          <a href="/iletisim">İletişim</a>
          <a href="/teslimat-iade">Teslimat ve İade</a>
          <a href="/gizlilik-politikasi">Gizlilik Politikası</a>
          <a href="/mesafeli-satis-sozlesmesi">Mesafeli Satış Sözleşmesi</a>
        </div>
        <p class="text-muted">Dersekos VIP {{ date('Y') }} &copy; Tüm Hakları Saklıdır </p>
        <div>
          <img src="{{asset('assets/img/iyzico-logo.png')}}" alt="">
        </div>
      </div>
    </div>
  </footer>
<!-- jquery cdn --> 
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // nav-toggle click event
  document.querySelector('.nav-toggle').addEventListener('click', function() {
    var topNavbar = document.querySelector('.top-navbar');
    if (topNavbar.style.display === 'flex') {
      //hide with slide down effect with jQuery
      $(topNavbar).slideUp();
      
    } else {
      //topNavbar.style.display = 'flex';
      //show with slide down effect with jQuery
      $(topNavbar).slideDown();
      $('.top-navbar').css('display', 'flex');
      
    }
  });
</script>

  </body>
</html>