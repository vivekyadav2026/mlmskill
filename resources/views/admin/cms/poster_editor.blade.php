@extends(request()->is('admin/*') ? 'layouts.admin' : 'layouts.user')

@section('content')
<!-- Cropper.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css">
<style>
  .editor-card { background: #1a222d; border: 1px solid #334155; border-radius: .75rem; overflow: hidden; }
  .editor-header { background: #0f172a; padding: .85rem 1.5rem; border-bottom: 1px solid #334155; }
  .editor-body { padding: 1.5rem; }
  .workspace { background: #0b1220; border: 2px dashed #334155; border-radius: .5rem; min-height: 450px; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; }
  .cropper-container { max-width: 100%; max-height: 450px; }
  .cropper-container img { max-width: 100%; max-height: 450px; display: block; }
  .btn-action { background: #1e293b; border: 1px solid #475569; color: #e2e8f0; padding: .5rem 1rem; border-radius: .375rem; font-weight: 500; cursor: pointer; transition: all .2s; }
  .btn-action:hover:not(:disabled) { background: #334155; border-color: #64748b; }
  .btn-action.active { background: #4f46e5; border-color: #6366f1; color: white; }
  .btn-action:disabled { opacity: 0.5; cursor: not-allowed; }
</style>

<div class="tailwind-scope mt-4 max-w-6xl mx-auto">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-100"><i class="fa-solid fa-crop-simple mr-2 text-indigo-400"></i>Poster / Image Editor</h2>
            <p class="text-gray-400 text-sm">Crop, resize, rotate and adjust dimensions of your marketing posters and banners.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Controls Column -->
        <div class="lg:col-span-1 space-y-4">
            <div class="editor-card">
                <div class="editor-header"><h3 class="text-sm font-semibold text-gray-300"><i class="fa-solid fa-upload mr-1.5 text-indigo-400"></i> 1. Choose Image</h3></div>
                <div class="editor-body">
                    <input type="file" id="fileUpload" accept="image/*" class="hidden">
                    <button type="button" onclick="document.getElementById('fileUpload').click()" class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold shadow transition flex items-center justify-center gap-2">
                        <i class="fa-solid fa-file-image"></i> Upload Image
                    </button>
                    <p class="text-xs text-gray-500 mt-2 text-center">Supports JPG, PNG & GIF up to 5MB.</p>
                </div>
            </div>

            <div class="editor-card">
                <div class="editor-header"><h3 class="text-sm font-semibold text-gray-300"><i class="fa-solid fa-expand mr-1.5 text-indigo-400"></i> 2. Select Dimensions</h3></div>
                <div class="editor-body space-y-2">
                    <div>
                        <label class="text-xs text-gray-500 font-bold block mb-1">ASPECT RATIOS</label>
                        <div class="grid grid-cols-2 gap-2">
                            <button type="button" class="btn-action active ratio-btn" data-ratio="1">1:1 (Square)</button>
                            <button type="button" class="btn-action ratio-btn" data-ratio="0.75">4:3 (Classic)</button>
                            <button type="button" class="btn-action ratio-btn" data-ratio="1.77777777778">16:9 (Landscape)</button>
                            <button type="button" class="btn-action ratio-btn" data-ratio="0.5625">9:16 (Vertical)</button>
                            <button type="button" class="btn-action ratio-btn" data-ratio="0.8">4:5 (Portrait)</button>
                            <button type="button" class="btn-action ratio-btn" data-ratio="2.5">5:2 (Banner)</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="editor-card">
                <div class="editor-header"><h3 class="text-sm font-semibold text-gray-300"><i class="fa-solid fa-screwdriver-wrench mr-1.5 text-indigo-400"></i> 3. Editing Tools</h3></div>
                <div class="editor-body space-y-3">
                    <div class="flex gap-2">
                        <button type="button" class="btn-action flex-1" id="btnRotateLeft" disabled><i class="fa-solid fa-rotate-left mr-1"></i> Left</button>
                        <button type="button" class="btn-action flex-1" id="btnRotateRight" disabled><i class="fa-solid fa-rotate-right mr-1"></i> Right</button>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="btn-action flex-1" id="btnFlipX" disabled><i class="fa-solid fa-arrows-left-right mr-1"></i> Flip H</button>
                        <button type="button" class="btn-action flex-1" id="btnFlipY" disabled><i class="fa-solid fa-arrows-up-down mr-1"></i> Flip V</button>
                    </div>
                    <button type="button" class="btn-action w-full" id="btnReset" disabled><i class="fa-solid fa-arrows-rotate mr-1"></i> Reset Editor</button>
                </div>
            </div>

            <div class="editor-card">
                <div class="editor-header"><h3 class="text-sm font-semibold text-gray-300"><i class="fa-solid fa-download mr-1.5 text-indigo-400"></i> 4. Export Poster</h3></div>
                <div class="editor-body">
                    <form action="{{ request()->is('admin/*') ? route('admin.cms.poster-editor.download') : route('user.invite.poster-editor.download') }}" method="POST" id="downloadForm">
                        @csrf
                        <input type="hidden" name="image" id="downloadImage">
                        <button type="submit" id="btnDownload" disabled class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold shadow transition flex items-center justify-center gap-2">
                            <i class="fa-solid fa-download"></i> Download Crop
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Canvas Workspace Column -->
        <div class="lg:col-span-3">
            <div class="workspace">
                <div id="uploadPrompt" class="text-center text-gray-500">
                    <i class="fa-solid fa-image text-6xl mb-4 block text-gray-700"></i>
                    Upload an image to start cropping and adjusting dimensions
                </div>
                <div id="cropWorkspace" class="hidden cropper-container">
                    <img id="editingImage" src="">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cropper.js Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>
<script>
let cropper = null;
const fileUpload = document.getElementById('fileUpload');
const editingImage = document.getElementById('editingImage');
const uploadPrompt = document.getElementById('uploadPrompt');
const cropWorkspace = document.getElementById('cropWorkspace');
const downloadForm = document.getElementById('downloadForm');
const downloadImageHidden = document.getElementById('downloadImage');

// Actions buttons
const btnRotateLeft = document.getElementById('btnRotateLeft');
const btnRotateRight = document.getElementById('btnRotateRight');
const btnFlipX = document.getElementById('btnFlipX');
const btnFlipY = document.getElementById('btnFlipY');
const btnReset = document.getElementById('btnReset');
const btnDownload = document.getElementById('btnDownload');

let flipH = 1;
let flipV = 1;
let currentAspectRatio = 1;

fileUpload.addEventListener('change', function(e) {
    const files = e.target.files;
    if (files && files.length > 0) {
        const reader = new FileReader();
        reader.onload = function(event) {
            editingImage.src = event.target.result;
            uploadPrompt.classList.add('hidden');
            cropWorkspace.classList.remove('hidden');

            if (cropper) {
                cropper.destroy();
            }

            initCropper(currentAspectRatio);
            enableEditingButtons();
        };
        reader.readAsDataURL(files[0]);
    }
});

function initCropper(aspectRatio) {
    cropper = new Cropper(editingImage, {
        aspectRatio: aspectRatio,
        viewMode: 1,
        dragMode: 'move',
        autoCropArea: 0.8,
        restore: false,
        guides: true,
        center: true,
        highlight: false,
        cropBoxMovable: true,
        cropBoxResizable: true,
        toggleDragModeOnDblclick: false,
    });
}

function enableEditingButtons() {
    btnRotateLeft.disabled = false;
    btnRotateRight.disabled = false;
    btnFlipX.disabled = false;
    btnFlipY.disabled = false;
    btnReset.disabled = false;
    btnDownload.disabled = false;
}

// Rotate
btnRotateLeft.addEventListener('click', () => { if (cropper) cropper.rotate(-90); });
btnRotateRight.addEventListener('click', () => { if (cropper) cropper.rotate(90); });

// Flip H/V
btnFlipX.addEventListener('click', () => {
    if (cropper) {
        flipH = flipH === 1 ? -1 : 1;
        cropper.scaleX(flipH);
    }
});
btnFlipY.addEventListener('click', () => {
    if (cropper) {
        flipV = flipV === 1 ? -1 : 1;
        cropper.scaleY(flipV);
    }
});

// Reset
btnReset.addEventListener('click', () => {
    if (cropper) {
        cropper.reset();
        flipH = 1;
        flipV = 1;
        cropper.scale(1, 1);
    }
});

// Ratio click
document.querySelectorAll('.ratio-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.ratio-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        const ratio = parseFloat(this.getAttribute('data-ratio'));
        currentAspectRatio = ratio;
        if (cropper) {
            cropper.setAspectRatio(ratio);
        }
    });
});

// Form download submit handler
downloadForm.addEventListener('submit', function(e) {
    if (cropper) {
        e.preventDefault();
        const canvas = cropper.getCroppedCanvas();
        downloadImageHidden.value = canvas.toDataURL('image/jpeg', 0.95);
        downloadForm.submit();
    }
});
</script>
@endsection
