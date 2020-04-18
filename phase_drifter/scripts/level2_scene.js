class level2_scene extends Phaser.Scene {
    constructor() {
        super("level2");
    }

    preload() {
        this.load.image('background', '../assets/level_1/background.png');
        this.load.image('plat1', '../assets/level_1/tile1.png'); // center pixel = 155
        this.load.image('plat2', '../assets/level_1/tile2.png'); // center pixel = 52
        this.load.image('plat3', '../assets/level_1/tile3.png'); // center pixel = 235
        this.load.image('plat4', '../assets/level_1/tile4.png'); // center pixel = 12
        this.load.image('plat5', '../assets/level_1/tile5.png'); // center pixel = 80
        this.load.image('key', '../assets/level_1/key.png');
        this.load.image('spikes', '../assets/level_1/spikes.png'); // center pixel; = 47
        this.load.image('door', '../assets/door.png'); // center pixel = 52
        this.load.spritesheet('dude', '../assets/dude.png', {
            frameWidth: 32,
            frameHeight: 36
        });
    }

    create() {
        // Add background
        this.add.image(400, 300, 'background');

        // Create a static physics group and assign it to platforms
        platforms = this.physics.add.staticGroup();

        // Add platforms to level
        platforms.create(155, 150, 'plat1');

        // Create playerxw
        player = this.physics.add.sprite(176, 80, 'dude');
        player.setCollideWorldBounds(true);
        player.setSize(22,36);


        // Animations for dude spritesheet
        this.anims.create({
            key: 'left',
            frames: this.anims.generateFrameNumbers('dude', { start: 0, end: 3 }),
            frameRate: 5,
            repeat: -1
        });

        this.anims.create({
            key: 'turn',
            frames: [ { key: 'dude', frame: 4 } ],
            frameRate: 20
        });

        this.anims.create({
            key: 'jump_right',
            frames: [ { key: 'dude', frame: 11 } ],
            frameRate: 20
        });

        this.anims.create({
            key: 'jump_left',
            frames: [ { key: 'dude', frame: 9 } ],
            frameRate: 20
        });

        this.anims.create({
            key: 'jump',
            frames: [ { key: 'dude', frame: 10 } ],
            frameRate: 20
        });

        this.anims.create({
            key: 'right',
            frames: this.anims.generateFrameNumbers('dude', { start: 5, end: 8 }),
            frameRate: 5,
            repeat: -1
        });

        // create cursor which is Phaser's built in keyboard manager (suppliments event listeners)
        cursors = this.input.keyboard.createCursorKeys();

        // Check for collision against platforms and player
        this.physics.add.collider(player, platforms);
    }

    update() {

        // End game if gameOver == true. 
        if(gameOver) {
            return;
        }

        // Controller code for player. These conditionals are checking what key is pressed to execute which animation.
        if (cursors.left.isDown)
        {
            player.setVelocityX(-160);
            player.anims.play('left', true);
            if (!player.body.touching.down)
            {
                player.anims.play('jump_left');
            }
        }
        else if (cursors.right.isDown)
        {
            player.setVelocityX(160);

            player.anims.play('right', true);
            if (!player.body.touching.down)
            {
                player.anims.play('jump_right');
            }
        }
        else
        {
            player.setVelocityX(0);
            player.anims.play('turn');
            if (!player.body.touching.down) {
                player.anims.play('jump');
            }
        }

        if (cursors.up.isDown && player.body.touching.down)
        {
            player.setVelocityY(-230);
        }
    }
}