var Gin = function(containerId, superId, modelPath, scaleByHeight) {
	var self = this;

	this.geoOriginal = [];
	this.geoTemp = [];
	this.rands = [];

	this.animationCounter = 0;
	this.factor = 0.4;
	this.speed = 50;
	this.animations = [];
	this.animationIndex = -1;

	this.animations.push(this.animateLaser.bind(this));
	this.animations.push(this.animateNoise.bind(this));
	this.animations.push(this.animateTan.bind(this));

	this.animationCallback = function() {self.start()};
	this.enabled = true;


	if (Detector.webgl) {
		this.renderer = new THREE.WebGLRenderer({ antialias : true, alpha:true });
	} else {
		this.enabled = false;
		document.getElementById(superId).style.display = 'none';
		return;
	}
	this.container = document.getElementById(containerId);

	if (!scaleByHeight) {
		this.renderer.setSize( this.container.offsetWidth, this.container.offsetWidth );
	} else {
		this.renderer.setSize( this.container.offsetHeight, this.container.offsetHeight );
	}


	this.container.appendChild(this.renderer.domElement);

	window.addEventListener( 'resize', function(){
		var w;
		var h;
		if (!scaleByHeight) {
			w = self.container.offsetWidth;
			h = w;
		} else {
			h = self.container.offsetHeight;
			w = h;
		}


		self.renderer.setSize( w, h );
	}, false );

	this.scene = new THREE.Scene();
	this.camera = new THREE.PerspectiveCamera(35, 1, 1, 10000 );
	this.camera.position.set(0, 0, 25);
	this.scene.add(this.camera);

	new THREE.JSONLoader().load(
		modelPath,
		function (geometry, materials) {

			self.mesh = new THREE.SkinnedMesh( geometry, new THREE.MeshBasicMaterial({color : 0x000000}));
			self.mesh.rotateX( Math.PI / 2 );
			self.mesh.geometry.dynamic = true;
			self.scene.add( self.mesh );

			for (var i = 0; i < self.mesh.geometry.vertices.length; i++) {
				self.geoOriginal.push(self.mesh.geometry.vertices[i].clone());
				self.geoTemp.push(self.mesh.geometry.vertices[i].clone());
				self.rands.push(Math.random());
			}
			self.startAnimation(Math.floor(Math.random() * 3));
		}
	);
};


Gin.prototype.animateTan = function() {
	for (var i = 0; i < this.mesh.geometry.vertices.length; i++) {
		this.mesh.geometry.vertices[i].y = this.geoOriginal[i].y + Math.sin(this.geoOriginal[i].x + this.animationCounter / 10);
	}
};

Gin.prototype.animateNoise = function() {

	var phase = Math.sin(this.animationCounter / this.speed);


	if (phase < 0 && Math.sin((this.animationCounter -1) / this.speed) >= 0) {
		this.factor = Math.random() * 0.25;
		this.speed = (Math.random() * 50) +10;
	}

	var glitchX = Math.random() < 0.1;
	var glitchXPosition = Math.random() * 10;
	var glitchXFactor = (Math.random() - 0.5);

	var glitchY = Math.random() < 0.1;
	var glitchYPosition = Math.random() * 10;
	var glitchYFactor = (Math.random() - 0.5) * 2;

	for (var i = 0; i < this.mesh.geometry.vertices.length; i++) {


		if (Math.random() < 0.5) {
			this.mesh.geometry.vertices[i].x = this.geoOriginal[i].x + (Math.random()) * phase * this.factor;
		} else {
			this.mesh.geometry.vertices[i].x = this.geoOriginal[i].x;
		}


		if (Math.random() < 0.5) {
			this.mesh.geometry.vertices[i].z = this.geoOriginal[i].z + (Math.random())  * phase * this.factor;
		} else {
			this.mesh.geometry.vertices[i].z = this.geoOriginal[i].z;
		}

		if (glitchX) {
			if (this.geoOriginal[i].z + 5 < glitchXPosition) {
				this.mesh.geometry.vertices[i].x = this.geoOriginal[i].x + glitchXFactor;
			}
		}

		if (glitchY) {
			if (this.geoOriginal[i].x + 5 < glitchYPosition) {
				this.mesh.geometry.vertices[i].y = this.geoOriginal[i].y + glitchYFactor;
			}
		}

	}
};


Gin.prototype.animateLaser = function() {
	for (var i = 0; i < this.mesh.geometry.vertices.length; i++) {
		this.mesh.geometry.vertices[i].y = Math.min(this.geoOriginal[i].y + Math.tan((this.geoOriginal[i].z) + this.animationCounter / 10), 4);
	}
};


Gin.prototype.start = function() {
	if (!this.enabled) {
		return;
	}

	requestAnimationFrame( this.animationCallback );
	this.animationCounter += 1;
	if (this.mesh) {
		if (this.animationIndex >= 0 && this.animationIndex < this.animations.length) {
			this.animations[this.animationIndex]();
		}

		//this.animateLaser();
		//this.animateNoise();
		//this.animateTan();
		this.mesh.geometry.verticesNeedUpdate = true;
	}
	this.renderer.render( this.scene, this.camera );
};

Gin.prototype.reset = function() {
	if (!this.enabled) {
		return;
	}
	for (var i = 0; i < this.mesh.geometry.vertices.length; i++) {
		this.mesh.geometry.vertices[i].x = this.geoOriginal[i].x;
		this.mesh.geometry.vertices[i].y = this.geoOriginal[i].y;
		this.mesh.geometry.vertices[i].z = this.geoOriginal[i].z;
	}
};

Gin.prototype.startAnimation = function(index) {
	if (!this.enabled) {
		return;
	}
	this.reset();
	this.animationIndex = index;
};

var gin = new Gin("animationContainer", "animationWrap", "fileadmin/razor/Models/Gineale.json");
gin.start();

