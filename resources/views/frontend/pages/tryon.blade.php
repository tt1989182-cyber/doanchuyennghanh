@extends('frontend.layouts.master')

@section('main-content')

<style>
    
/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: #fff;
    padding: 30px;
    border-radius: 20px;
    width: 90%;
    max-width: 600px;
    position: relative;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5);
}

.close-btn {
    position: absolute;
    right: 20px;
    top: 15px;
    font-size: 2rem;
    cursor: pointer;
    color: #333;
    transition: color 0.3s ease;
    z-index: 10;
}

.close-btn:hover {
    color: #ff4757;
}

.camera-wrapper {
    position: relative;
    width: 100%;
    height: 400px;
    border-radius: 15px;
    overflow: hidden;
    background: #000;
    margin-bottom: 20px;
}

#cameraStream {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transform: scaleX(-1);
}

#necklaceOverlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: contain;
    pointer-events: none;
    display: none;
}

#tryonTitle {
    font-size: 2rem;
    color: #333;
    margin-bottom: 10px;
    text-align: center;
}

#tryonDesc {
    font-size: 1.1rem;
    color: #666;
    line-height: 1.6;
    text-align: center;
}

/* Responsive */
@media (max-width: 992px) {
    .collection-item {
        flex-direction: column !important;
        gap: 40px;
        text-align: center;
    }
    
    .model-viewer-container,
    .collection-content {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .model3d {
        height: 400px;
    }
    
    .collection-content {
        text-align: center;
    }
}

@media (max-width: 768px) {
    .collection-section {
        padding: 60px 0;
    }
    
    .model3d {
        height: 300px;
    }
    
    .collection-content h4 {
        font-size: 1.8rem;
    }
    
    .collection-content p {
        font-size: 1.1rem;
    }
    
    .btnTryOn {
        padding: 12px 30px;
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .camera-wrapper {
        height: 300px;
    }
    
    .modal-content {
        padding: 20px;
        width: 95%;
    }
}
/* Collection Section */
.collection-section {
    padding: 80px 0;
    background: #fff;
}

.collection-section .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.collection-item {
    display: flex;
    align-items: center;
    margin-bottom: 80px;
    gap: 60px;
}

.collection-item:nth-child(even) {
    flex-direction: row-reverse;
}

/* Image/Model Viewer Section */
.model-viewer-container {
    flex: 0 0 60%;
    max-width: 60%;
}

.model3d {
    width: 100%;
    height: 500px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    background: #f8f9fa;
}

/* Content Section */
.collection-content {
    flex: 0 0 35%;
    max-width: 35%;
    text-align: left;
}

.collection-content h4 {
    font-size: 2.2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.collection-content p {
    font-size: 1.2rem;
    color: #666;
    line-height: 1.8;
    margin-bottom: 30px;
    font-weight: 300;
}

/* Button Styles */
.btnTryOn {
    background: linear-gradient(135deg, #dbdbddff 0%, #4e4d4fff 100%);
    color: white;
    border: none;
    padding: 15px 40px;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.btnTryOn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
}

.btnTryOn:active {
    transform: translateY(-1px);
}

/* Section Title */
.section-title {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 60px;
    text-transform: uppercase;
    letter-spacing: 2px;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 2px;
}

/* Responsive */
@media (max-width: 992px) {
    .collection-item {
        flex-direction: column !important;
        gap: 40px;
        text-align: center;
    }
    
    .model-viewer-container,
    .collection-content {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .model3d {
        height: 400px;
    }
    
    .collection-content {
        text-align: center;
    }
}

@media (max-width: 768px) {
    .collection-section {
        padding: 60px 0;
    }
    
    .model3d {
        height: 300px;
    }
    
    .collection-content h4 {
        font-size: 1.8rem;
    }
    
    .collection-content p {
        font-size: 1.1rem;
    }
    
    .btnTryOn {
        padding: 12px 30px;
        font-size: 1rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
}
</style>

<div class="collection-section">
    <div class="container">
        <h2 class="section-title">Bộ sưu tập sắp ra mắt</h2>
        
        <!-- Item 1 -->
        <div class="collection-item">
            <div class="model-viewer-container">
                <model-viewer class="model3d" src="/models/necklace1.glb" alt="Bộ sưu tập 1" camera-controls auto-rotate></model-viewer>
            </div>
            <div class="collection-content">
                <h4>Bộ sưu tập 1</h4>
                <p>Bộ sưu tập lấy cảm hứng từ mùa đông lạnh giá với thiết kế tinh tế và sang trọng, mang đến vẻ đẹp quyến rũ cho người đeo.</p>
                <button class="btnTryOn"
                        data-name="Bộ sưu tập 1"
                        data-desc="Mô tả 1"
                        data-src="/models/necklace1.png">
                    Trải nghiệm
                </button>
            </div>
        </div>

        <!-- Item 2 -->
        <div class="collection-item">
            <div class="model-viewer-container">
                <model-viewer class="model3d" src="/models/necklace2.glb" alt="Bộ sưu tập 2" camera-controls auto-rotate></model-viewer>
            </div>
            <div class="collection-content">
                <h4>Bộ sưu tập mùa Đông</h4>
                <p>AURA từ lâu đã tin rằng kim cương, chứ không phải những viên kim loại nặng nề, mới là yếu tố quyết định thiết kế và độ sáng bóng của chúng phải được đặt lên hàng đầu. Họa tiết của bộ sưu tập mùa Đông ra đời vào một đêm đông giá lạnh những năm 1940, sau khi ông Winston quan sát cách những tinh thể băng tuyết hình thành trên một vòng hoa nguyệt quế trang trí.</p>
                <button class="btnTryOn"
                        data-name="Bộ sưu tập 2"
                        data-desc="Mô tả 2"
                        data-src="/models/neckace2.png">
                    Trải nghiệm
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Item 3 -->
<div class="collection-item">
    <div class="model-viewer-container">
        <model-viewer class="model3d" 
            src="/models/do.glb" 
            alt="Bộ sưu tập 4" 
            camera-controls 
            auto-rotate>
        </model-viewer>
    </div>
    <div class="collection-content">
        <h4>Bộ sưu tập Hoàng Kim</h4>
        <p>Lấy cảm hứng từ sắc vàng quyền lực, bộ sưu tập Hoàng Kim tôn vinh vẻ đẹp sang trọng và đẳng cấp vượt thời gian.</p>

        <button class="btnTryOn"
                data-name="Bộ sưu tập Hoàng Kim"
                data-desc="Sang trọng – quý phái – đẳng cấp."
                data-src="/models/do.png">
            Trải nghiệm
        </button>
    </div>
</div>
<!-- Item 4 -->
<div class="collection-item">
    <div class="model-viewer-container">
        <model-viewer class="model3d" 
            src="/models/vang.glb" 
            alt="Bộ sưu tập 3" 
            camera-controls 
            auto-rotate>
        </model-viewer>
    </div>
    <div class="collection-content">
        <h4>Bộ sưu tập Ánh Trăng</h4>
        <p>Lấy cảm hứng từ ánh trăng dịu nhẹ phản chiếu trên mặt nước, bộ sưu tập mang đến vẻ đẹp mềm mại nhưng đầy mê hoặc.</p>

        <button class="btnTryOn"
                data-name="Bộ sưu tập Ánh Trăng"
                data-desc="Trang sức mang hơi thở thanh lịch, nhẹ nhàng."
                data-src="/models/vang.png">
            Trải nghiệm
        </button>
    </div>
</div>


<div id="tryonModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h3 id="tryonTitle" class="text-center mb-2"></h3>
        <div class="camera-wrapper">
            <video id="cameraStream" autoplay muted playsinline></video>
            <img id="necklaceOverlay" src="">
        </div>
        <p id="tryonDesc" class="text-center mt-3"></p>
    </div>
</div>

<!-- Thư viện -->
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh"></script>
<script src="https://cdn.jsdelivr.net/npm/@mediapipe/camera_utils"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

<script>
let stream = null;
let faceMesh = null;
let camera = null;

// Bấm trải nghiệm
document.querySelectorAll(".btnTryOn").forEach(btn => {
    btn.addEventListener("click", function() {
        document.getElementById("tryonTitle").textContent = this.dataset.name;
        document.getElementById("tryonDesc").textContent = this.dataset.desc;
        document.getElementById("necklaceOverlay").src = this.dataset.src;

        document.getElementById("tryonModal").style.display = "flex";
        startCamera();
    });
});

// Đóng modal
document.querySelector(".close-btn").addEventListener("click", closeTryOn);
function closeTryOn() {
    document.getElementById("tryonModal").style.display = "none";
    if (camera) { camera.stop(); camera = null; }
    if (stream) { stream.getTracks().forEach(t => t.stop()); stream = null; }
    if (faceMesh) { faceMesh.close(); faceMesh = null; }
}

// Khởi động camera + FaceMesh
async function startCamera() {
    const video = document.getElementById("cameraStream");
    const overlay = document.getElementById("necklaceOverlay");

    faceMesh = new FaceMesh({locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/face_mesh/${file}`});
    faceMesh.setOptions({
        maxNumFaces: 1,
        refineLandmarks: true,
        minDetectionConfidence: 0.5,
        minTrackingConfidence: 0.5
    });

    faceMesh.onResults(results => {
    if (!results.multiFaceLandmarks || !results.multiFaceLandmarks[0]) return;
    const landmarks = results.multiFaceLandmarks[0];

    // Sử dụng các điểm landmark chính xác hơn cho cổ
    const chin = landmarks[152];        // Cằm dưới
    const neckBottom = landmarks[164];  // Đáy cổ
    const leftJaw = landmarks[234];     // Hàm trái
    const rightJaw = landmarks[454];    // Hàm phải

    const videoWidth = video.offsetWidth;
    const videoHeight = video.offsetHeight;

    const faceWidth = Math.abs(rightJaw.x - leftJaw.x) * videoWidth;
    const neckHeight = Math.abs(neckBottom.y - chin.y) * videoHeight;

    // Tính toán vị trí trung tâm dây chuyền
    const centerX = (1 - chin.x) * videoWidth - (faceWidth * 1.3) / 2;
    
    // Đặt dây chuyền ngay dưới cằm, cách 1/3 chiều cao cổ
    const centerY = chin.y * videoHeight + (neckHeight * 0.3);

    // Kích thước dây chuyền tỷ lệ với khuôn mặt
    overlay.style.width = `${faceWidth * 1.4}px`;
    overlay.style.height = `${faceWidth * 0.8}px`; // Dây chuyền thường dẹp hơn
    
    // Đặt vị trí
    overlay.style.position = "absolute";
    overlay.style.left = `${centerX}px`;
    overlay.style.top = `${centerY}px`;
    overlay.style.transform = "scaleX(-1)"; // Mirror để khớp video
    
    overlay.style.display = "block";

    // Debug log
    console.log('Neck position:', {
        chinY: chin.y * videoHeight,
        neckBottomY: neckBottom.y * videoHeight,
        neckHeight: neckHeight,
        centerY: centerY
    });
});

    camera = new Camera(video, {
        onFrame: async () => { await faceMesh.send({image: video}); },
        width: 360,
        height: 360
    });

    await camera.start();
}
</script>

@endsection
