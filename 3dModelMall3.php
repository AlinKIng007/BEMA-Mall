<?php


require 'components/connect.php';



session_start();

require 'components/prevention.php';



$select_products = $conn->prepare("SELECT p.id AS id, m.product_name AS product_name, p.price AS price, p.amount AS amount from main_products m INNER JOIN products p on m.id=p.main_product_id; ORDER BY p.id");
$select_products->execute();
$product_data = [];

if ($select_products->rowCount() > 0) {
    $product_data = array(); // Move this line outside the loop

    while ($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)) {
        $product_data[] = $fetch_product;
    }

    // Now $product_data contains the data from the SQL query
    // Convert the PHP array to a JSON string if needed
    $json_product_data = json_encode($product_data);

} else {
  trigger_error("no products", E_USER_ERROR);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>BEMA's 3D Interactive Shop</title>
  <style>
    body {
      margin: 0;
    }
    canvas {
      display: block;
    }
    #positionDisplay {
      position: fixed;
      top: 10px;
      left: 35%;
      color: blue;
      font-family: Arial;
    }
  </style>
</head>
<body>
<div id="positionDisplay">Camera Position: X=0.00, Y=0.00, Z=0.00, Rotation: X=0.00, Y=0.00, Z=0.00</div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
  <script type="module">

    
import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";

import { GLTFLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/GLTFLoader.js";
const gltfLoader = new GLTFLoader();
const fontLoader = new THREE.FontLoader();
    
    // Set up the scene, camera, and renderer
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(
      75,
      window.innerWidth / window.innerHeight,
      0.1,
      1000
    );
    const renderer = new THREE.WebGLRenderer({ alpha: true });
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);

    // Create light
    const topLight = new THREE.DirectionalLight(0xffffff, 1);
    topLight.position.set(500, 500, 500);
    topLight.castShadow = true;
    scene.add(topLight);





    // Create walls
    const wallGeometry = new THREE.BoxGeometry(201, 10, 0.2); // Adjusted dimensions
    const wallMaterial = new THREE.MeshBasicMaterial({ color: 0xcccccc });
    const backWall = new THREE.Mesh(wallGeometry, wallMaterial);
    backWall.position.z = -10;
    scene.add(backWall);

    const frontwall = new THREE.Mesh(wallGeometry, wallMaterial);
    frontwall.position.z = 10;
    scene.add(frontwall);

let modelName = <?php echo json_encode($_GET['model_name']); ?>

    // Create floor
    const floorGeometry = new THREE.PlaneGeometry(201, 20); // Adjusted dimensions
    const floorMaterial = new THREE.MeshBasicMaterial({ color: 0xaaaaaa, side: THREE.DoubleSide });
    const floor = new THREE.Mesh(floorGeometry, floorMaterial);
    floor.rotation.x = -Math.PI / 2;
    floor.position.y = -5; // Adjusted position
    scene.add(floor);
    const celling = new THREE.Mesh(floorGeometry, floorMaterial);
    celling.rotation.x = -Math.PI / 2;
    celling.position.y = 5; // Adjusted position
    scene.add(celling);





    // making the products and the text for red shelf
    let spnum = -100;
    let dbnum = 0;
    
    const shelfGeometry = new THREE.BoxGeometry(201, 0.2, 2);
const shelfMaterial = new THREE.MeshBasicMaterial({ color: 0xffffff });

const productGeometry = new THREE.BoxGeometry(1, 1, 1);
const productMaterial = new THREE.MeshBasicMaterial({ color: 0xffffff });
const productMaterial2 = new THREE.MeshBasicMaterial({ color: 0x000000 });
// const textMaterial = new THREE.MeshBasicMaterial({ color: 0x333333 });
const loader = new THREE.FontLoader();

const shelfSpacing = 2; // Adjust this value based on the spacing you want

let x1,y1,z1 = 0;

function createShelfAndProducts(num, dataIndexOffset) {
  for (let i = 0; i < 3; i++) {
    for (let j = 0; j < 3; j++) {
      const product = new THREE.Mesh(productGeometry, productMaterial);
      product.position.x = num + j * 5 + 1;
      product.position.y = -1.2 + i * 2.1+-2.4;
      product.position.z = -6 + Math.floor(j / 3) * 2;
      scene.add(product);

      loader.load('https://threejs.org/examples/fonts/helvetiker_regular.typeface.json', function (font) {
        const productData = JSON.parse('<?php echo json_encode($product_data); ?>');
        const dataIndex = i * 3 + j + dataIndexOffset;
        
        const textGeometryName = new THREE.TextGeometry(`${productData[dataIndex].product_name}`, {
          font: font,
          size: 0.2,
          height: 0.05,
        });

        const textGeometryPrice = new THREE.TextGeometry(`${productData[dataIndex].price}`, {
          font: font,
          size: 0.2,
          height: 0.05,
        });

        const textGeometryamount= new THREE.TextGeometry(`${productData[dataIndex].amount}`, {
          font: font,
          size: 0.2,
          height: 0.05,
        });

        x1 = num + j * 5;;
        y1 = -1.2 + i * 2.1+-2.4;
        z1 = -5 + Math.floor(j / 5) * 2;

        const textGeometryxyz= new THREE.TextGeometry(x1+' '+y1+' '+z1, {
          font: font,
          size: 0.2,
          height: 0.05,
        });

        const text1Mesh = new THREE.Mesh(textGeometryName, new THREE.MeshBasicMaterial({ color: 0x333333 }));
        const text2Mesh = new THREE.Mesh(textGeometryPrice, new THREE.MeshBasicMaterial({ color: 0x777777 }));
        const text3Mesh = new THREE.Mesh(textGeometryamount, new THREE.MeshBasicMaterial({ color: 0x999999 }));
        const text4Mesh = new THREE.Mesh(textGeometryxyz, new THREE.MeshBasicMaterial({ color: 0x000000 }));

        text1Mesh.position.x = num + j * 5;
        text1Mesh.position.y = -1.2 + i * 2.1+-2.4;
        text1Mesh.position.z = -5 + Math.floor(j / 5) * 2;

        text2Mesh.position.x = num + j * 5;
        text2Mesh.position.y = -1.2 + i * 2.1+-2.4 - 0.5;
        text2Mesh.position.z = -5 + Math.floor(j / 5) * 2;

        text3Mesh.position.x = num + j * 5;
        text3Mesh.position.y = -1.2 + i * 2.1+-2.4 -1;
        text3Mesh.position.z = -5 + Math.floor(j / 5) * 2;

        text4Mesh.position.x = num + j * 5;
        text4Mesh.position.y = -1.2 + i * 2.1+-2.4 +0.5;
        text4Mesh.position.z = -5 + Math.floor(j / 5) * 2;


        scene.add(text1Mesh,text2Mesh,text3Mesh,text4Mesh);
      });
    }

  }
  for (let b = 0; b < 10; b++) {
    if (modelName === 'mid' || modelName === 'high') {
    gltfLoader.load(
      `shelf.gltf`,
      function (gltf) {
        let object = gltf.scene; // Now 'object' is defined--------------------------------------------
        object.scale.y = 0.27;
        object.scale.x = 0.50;
        object.scale.z = 0.27;
        object.position.y = -4.9;
        object.position.z = -6;
        object.position.x = -94 + (b*20);
        scene.add(object);
      },
      function (xhr) {
        console.log((xhr.loaded / xhr.total * 100) + '% loaded');
      },
      function (error) {
        console.error(error);
      }
    );
}
}
for (let b = 0; b <= 3; b++) {
if (modelName === 'low'){
    const shelf = new THREE.Mesh(shelfGeometry, shelfMaterial);
  shelf.position.y = -6 + b*2; // Adjusted for spacing
  shelf.position.z = -6;
  scene.add(shelf);
  }
  else{
  console.log("error");
}
  }

}

  for (let x = 0; x < 10; x++) {
    createShelfAndProducts(spnum,(x*9));
    dbnum += 9;
    spnum += 20;
  }

  let x2,y2,z2 = 0;

function createShelfAndProducts2(num, dataIndexOffset) {
  for (let i = 0; i < 3; i++) {
    for (let j = 0; j < 3; j++) {
      const product = new THREE.Mesh(productGeometry, productMaterial2);
      product.position.x = num + j * 5 + 1;
      product.position.y = -1.2 + i * 2.1+-2.4;
      product.position.z = 6 + Math.floor(j / 3) * 2;
      scene.add(product);

      loader.load('https://threejs.org/examples/fonts/helvetiker_regular.typeface.json', function (font) {
        const productData = JSON.parse('<?php echo json_encode($product_data); ?>');
        const dataIndex = i * 3 + j + dataIndexOffset;
        
        const textGeometryName = new THREE.TextGeometry(`${productData[dataIndex].product_name}`, {
          font: font,
          size: 0.2,
          height: 0.05,
        });

        const textGeometryPrice = new THREE.TextGeometry(`${productData[dataIndex].price}`, {
          font: font,
          size: 0.2,
          height: 0.05,
        });

        const textGeometryamount= new THREE.TextGeometry(`${productData[dataIndex].amount}`, {
          font: font,
          size: 0.2,
          height: 0.05,
        });

        x2 = 2.3+(num + j * 5);
        y2 = -1.2 + i * 2.1+-2.4;
        z2 = 5 + Math.floor(j / 5) * 2;

        const textGeometryxyz= new THREE.TextGeometry(x2+' '+y2+' '+z2, {
          font: font,
          size: 0.2,
          height: 0.05,
        });

        // const textMesh = new THREE.Mesh(textGeometry, textMaterial);
        const text1Mesh = new THREE.Mesh(textGeometryName, new THREE.MeshBasicMaterial({ color: 0x333333 }));
        const text2Mesh = new THREE.Mesh(textGeometryPrice, new THREE.MeshBasicMaterial({ color: 0x777777 }));
        const text3Mesh = new THREE.Mesh(textGeometryamount, new THREE.MeshBasicMaterial({ color: 0x999999 }));
        const text4Mesh = new THREE.Mesh(textGeometryxyz, new THREE.MeshBasicMaterial({ color: 0x000000 }));
        text1Mesh.position.x = 2.3+(num + j * 5);
        text1Mesh.position.y = -1.2 + i * 2.1+-2.4;
        text1Mesh.position.z = 5 + Math.floor(j / 5) * 2;
        text1Mesh.rotation.y = Math.PI; // Rotate 180 degrees around the Y-axis

        text2Mesh.position.x = 2.3+(num + j * 5);
        text2Mesh.position.y = -1.2 + i * 2.1+-2.4 - 0.5;
        text2Mesh.position.z = 5 + Math.floor(j / 5) * 2;
        text2Mesh.rotation.y = Math.PI; // Rotate 180 degrees around the Y-axis

        text3Mesh.position.x = 2.3+(num + j * 5);
        text3Mesh.position.y = -1.2 + i * 2.1+-2.4 - 1;
        text3Mesh.position.z = 5 + Math.floor(j / 5) * 2;
        text3Mesh.rotation.y = Math.PI; // Rotate 180 degrees around the Y-axis

        text4Mesh.position.x = 2.3+(num + j * 5);
        text4Mesh.position.y = -1.2 + i * 2.1+-2.4 + 0.5;
        text4Mesh.position.z = 5 + Math.floor(j / 5) * 2;
        text4Mesh.rotation.y = Math.PI; // Rotate 180 degrees around the Y-axis

        scene.add(text1Mesh,text2Mesh,text3Mesh,text4Mesh);

      });
    }
  //   const shelf = new THREE.Mesh(shelfGeometry, shelfMaterial);
  // shelf.position.y = -2 + i*2; // Adjusted for spacing
  // shelf.position.z = 6;
  // scene.add(shelf);
  }

  for (let c = 0; c < 10; c++) {
    if (modelName === 'mid' || modelName === 'high') {
  gltfLoader.load(
      `shelf.gltf`,
      function (gltf) {
        let object = gltf.scene; // Now 'object' is defined--------------------------------------------
        object.scale.y = 0.27;
        object.scale.x = 0.50;
        object.scale.z = 0.27;
        object.position.y = -4.9;
        object.position.z = 6;
        object.position.x = -94 + (c*20);
        scene.add(object);
      },
      function (xhr) {
        console.log((xhr.loaded / xhr.total * 100) + '% loaded');
      },
      function (error) {
        console.error(error);
      }
    );
  }

  }
  for (let c = 0; c <= 3; c++) {
if (modelName === 'low'){
    const shelf = new THREE.Mesh(shelfGeometry, shelfMaterial);
  shelf.position.y = -6 + c*2; // Adjusted for spacing
  shelf.position.z = 6;
  scene.add(shelf);
  }
  else{
  console.log("error");
}
  }
}
  spnum = -100;
  for (let x = 0; x < 10; x++) {
    createShelfAndProducts2(spnum,dbnum+(x*9));
    spnum += 20;
  }


// Declare 'object' here with 'let' or 'const'
    // const object; // Use 'let' if you plan to reassign 'object', otherwise use 'const'



    camera.position.z = 0; // Move the camera back so we can see the scene
    camera.position.y = 0; // Move the camera up so we can see the scene
    camera.position.x = 0; // Move the camera to the center of the scene

    // Function to animate the scene
    function animate() {
      requestAnimationFrame(animate);
      renderer.render(scene, camera);
    }

    animate();

    // Function to handle key down events
    function onKeyDown(event) {
      switch (event.keyCode) {
        case 87: // W key
          camera.position.z -= 1;
          break;

        case 83: // S key
          camera.position.z += 1;
          break;

        case 65: // A key
          camera.position.x -= 1;
          break;

        case 68: // D key
          camera.position.x += 1;
          break;

        case 69: // E key
          camera.rotation.y -= 0.1;
          break;

        case 81: // Q key
          camera.rotation.y += 0.1;
          break;

          case 90: // z key
          camera.rotation.x -= 0.1;
          break;

          case 88: // x key
          camera.rotation.x += 0.1;
          break;

          case 32: // Space key
          camera.position.y += 0.5;
          break;

          case 16: // Shift key
          camera.position.y -= 0.5;
          break;

          case 8: // Shift key
          camera.rotation.y = 0;
          camera.rotation.x = 0;
          camera.rotation.z = 0;
          break;
      }
    }

    // Add keydown event listener
    window.addEventListener('keydown', onKeyDown, false);

  </script>
</body>
</html>