        </div>
      </div>
    </main>
    <footer class="app-footer">
      <?php include __DIR__ . '/../tmsnew/footer.php'; ?>
    </footer>
  </div>
  <?php $lte = '../tmsnew/'; ?>
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="<?php echo htmlspecialchars($lte, ENT_QUOTES, 'UTF-8'); ?>dist/js/adminlte.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var el = document.querySelector('.sidebar-wrapper');
      if (el && typeof OverlayScrollbarsGlobal !== 'undefined' && OverlayScrollbarsGlobal.OverlayScrollbars) {
        OverlayScrollbarsGlobal.OverlayScrollbars(el, {
          scrollbars: { theme: 'os-theme-light', autoHide: 'leave', clickScroll: true },
        });
      }
    });
  </script>
<?php
unset($GLOBALS['careers_sidebar_assets_included'], $GLOBALS['careers_tms_full_lte_shell']);
?>
</body>
</html>
