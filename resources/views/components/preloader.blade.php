<!-- Preloader -->
<div id="sd-preloader" style="position: fixed; inset: 0; z-index: 99999; background: #ffffff; display: flex; align-items: center; justify-content: center; transition: opacity 0.5s ease;">
    <div style="position: relative; display: flex; align-items: center; justify-content: center;">
        <div style="width: 5rem; height: 5rem; border-radius: 50%; border: 4px solid #e0e7ff; border-top-color: #4f46e5; animation: sd-spin 1s linear infinite;"></div>
        <div style="position: absolute; font-family: 'Outfit', sans-serif; font-weight: 900; color: #4f46e5; font-size: 1.25rem; animation: sd-pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;">SD</div>
    </div>
</div>

<style>
@keyframes sd-spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
@keyframes sd-pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }
</style>

<script>
    window.addEventListener('load', function() {
        var preloader = document.getElementById('sd-preloader');
        if(preloader) {
            preloader.style.opacity = '0';
            setTimeout(function() {
                preloader.style.display = 'none';
            }, 500);
        }
    });
</script>
