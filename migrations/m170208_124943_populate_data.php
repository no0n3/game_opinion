<?php

use app\models\Game;
use app\models\Image;
use yii\db\Migration;

/**
 * @author Velizar Ivanov <zivanof@gmail.com>
 */
class m170208_124943_populate_data extends Migration {

    public function safeUp() {
        foreach ($this->getGameData() as $gameData) {
            $game = new Game();
            $game->id = $gameData['id'];
            $game->name = $gameData['name'];
            $game->updates = $gameData['updates'];
            $game->description = $gameData['description'];
            $game->keywords = $gameData['keywords'];

            $game->save();
        }

        foreach ($this->getImageData() as $imageData) {
            $image = new Image();
            $image->id = $imageData['id'];
            $image->name = $imageData['name'];
            $image->title = $imageData['title'];
            $image->alt = $imageData['alt'];
            $image->rel_id = $imageData['rel_id'];
            $image->rel_type = $imageData['rel_type'];

            $image->save();
        }
    }

    private function getGameData() {
        return [
            [
                'id' => 1,
                'name' => 'World of Warcraft',
                'updates' => 0,
                'description' => 'World of Warcraft (WoW) is a massively multiplayer online role-playing game (MMORPG) released in 2004 by Blizzard Entertainment. It is the fourth released game set in the fantasy Warcraft universe, which was first introduced by Warcraft: Orcs & Humans in 1994.[3] World of Warcraft takes place within the Warcraft world of Azeroth, approximately four years after the events at the conclusion of Blizzard\'s previous Warcraft release, Warcraft III: The Frozen Throne.[4] Blizzard Entertainment announced World of Warcraft on September 2, 2001.[5] The game was released on November 23, 2004, on the 10th anniversary of the Warcraft franchise.',
                'keywords' => 'mmorpg, world of warcraft, wow, grind, painful grind, blizzard, holinka, holinka pls, holinka stahp',
            ],
            [
                'id' => 2,
                'name' => 'League of Legends',
                'updates' => 0,
                'description' => 'League of Legends (abbreviated LoL) is a multiplayer online battle arena video game developed and published by Riot Games for Microsoft Windows and macOS. The game follows a freemium model and is supported by microtransactions, and was inspired by the Warcraft III: The Frozen Throne mod, Defense of the Ancients.[1]

In League of Legends, players assume the role of an unseen "summoner" that controls a "champion" with unique abilities and battle against a team of other players or computer-controlled champions. The goal is usually to destroy the opposing team\'s "nexus", a structure which lies at the heart of a base protected by defensive structures. Each League of Legends match is discrete, with all champions starting off fairly weak but increasing in strength by accumulating items and experience over the course of the game.

League of Legends was generally well received at release, and has grown in popularity. By July 2012, League of Legends was the most played PC game in North America and Europe in terms of the number of hours played. As of January 2014, over 67 million people played League of Legends per month, 27 million per day, and over 7.5 million concurrently during peak hours. In September 2016 the company estimated that there are over 100 million active players each month.

League of Legends has an active and widespread competitive scene. In North America and Europe, Riot Games organizes the League Championship Series, located in Los Angeles and Berlin respectively, which consists of 10 professional teams in each continent. Similar regional competitions exist in China, South Korea, Taiwan, South America, and Southeast Asia. These regional competitions culminate with the annual World Championship, which in 2013, had a grand prize of $1 million and attracted 32 million viewers online.[9] The 2014 and 2015 tournaments each gave out one of the largest prize pools in eSports history, at $2.3 million. Winners also receive trophies, such as the Summoner\'s Cup, which was made by silversmiths Thomas Lyte.[12] The 2016 World Championship\'s total prizepool was over 5 million dollars, with over 2 million going over to the winner of the tournament',
                'keywords' => 'lol, league of legends, salty, moba, pvp, player versus player',
            ],
            [
                'id' => 3,
                'name' => 'Hearthstone',
                'updates' => 0,
                'description' => 'Hearthstone, originally known as Hearthstone: Heroes of Warcraft, is a free-to-play online collectible card video game developed and published by Blizzard Entertainment. Having been released worldwide on March 11, 2014, Hearthstone builds upon the already existing lore of the Warcraft series by using the same elements, characters, and relics. It was first released for Microsoft Windows and OS X, with support for iOS and Android devices being added later. The game features cross-platform play, allowing players on any device to compete with each other, restricted only by geographical region account limits.

The game is a turn-based card game between two opponents, using constructed decks of thirty cards along with a selected hero with a unique power. Players use mana points to cast spells or summon minions to attack the opponent, with the goal to reduce the opponent\'s health to zero. Winning matches can earn in-game gold, rewards in the form of new cards, and other in-game prizes. Players can then buy packs of new cards through gold or microtransactions to customize and improve their decks. The game features several modes of play, including casual and ranked matches, as well as daily quests and weekly challenges to help earn more gold and cards. New content for the game involves the addition of new card sets and gameplay, taking the form of either expansion packs or single-player adventures that reward the player with collectible cards upon completion.

In contrast to other games developed at Blizzard, Hearthstone was an experimental game developed by a smaller team based on the appreciation of collectible card games at the company. The game was designed to avoid pitfalls of other digital collectible card games by eliminating any possible plays from an opponent during a player\'s turn and by replicating the feel of a physical card game within the game\'s user interface. Many of the concepts as well as art assets were based on those previously published in the physical World of Warcraft Trading Card Game printed around 2008.

The game has been favorably reviewed by critics and proven successful for Blizzard. By April 2016, Blizzard has reported more than 50 million Hearthstone players. The game has become popular as an eSport, with cash-prize tournaments hosted by Blizzard and other organizers.',
                'keywords' => 'hearthstone, yu-gi-oh, hearth of the cards, lucky, rage quit, pocker face, blizzard',
            ],
            [
                'id' => 4,
                'name' => 'Overwatch',
                'updates' => 0,
                'description' => 'Overwatch is a team-based multiplayer first-person shooter video game developed and published by Blizzard Entertainment. It was released in May 2016 for Microsoft Windows, PlayStation 4, and Xbox One.

Overwatch puts players into two teams of six, with each player selecting one of several pre-defined hero characters with unique movement, attributes, and abilities; these heroes are divided into four classes: Offense, Defense, Tank and Support. Players on a team work together to secure and defend control points on a map and/or escort a payload across the map in a limited amount of time. Players gain cosmetic rewards that do not affect gameplay, such as character skins and victory poses, as they continue to play in matches. The game was launched with casual play, while Blizzard added competitive ranked play about a month after launch. Additionally, Blizzard has developed and added new characters, maps, and game modes post-release, while stating that all Overwatch updates will remain free, with the only additional cost to players being microtransactions to earn additional cosmetic rewards.

Overwatch is Blizzard\'s fourth major franchise, and came about following the 2014 cancellation of the ambitious massively multiplayer online role-playing game Titan. A portion of the Titan team came up with the concept of Overwatch, based on the success of team-based first-person shooters like Team Fortress 2 and the growing popularity of multiplayer online battle arenas, creating a hero-based shooter that emphasized teamwork. Some elements of Overwatch borrow assets and concepts from the canceled Titan project. After establishing the narrative of an optimistic near-future Earth setting after a global crisis, the developers aimed to create a diverse cast of heroes that spanned genders and ethnicities as part of this setting. Significant time was spent adjusting the balance of the characters, making sure that new players would still be able to have fun while skilled players would present each other with a challenge.

Overwatch was unveiled at BlizzCon 2014 in a fully playable state, and was in a closed beta from late 2015 through early 2016. An open beta in May 2016 drew in more than 9.7 million players. The release of the game was promoted with short animated videos to introduce the game\'s narrative and each of the characters. Upon official release, Overwatch received universal acclaim from critics, who praised its accessibility and enjoyable gameplay. Overwatch has become recognized as an eSport, and in addition to sponsoring tournaments, Blizzard has announced plans to help support professional league play starting in 2017.',
                'keywords' => 'overwatch, team fortress, team fortress 2, blizzard, fps, first person shooter',
            ],
            [
                'id' => 5,
                'name' => 'Starcraft',
                'updates' => 0,
                'description' => 'As Artanis, Hierarch of the mighty protoss race, you are poised to reclaim your fallen homeworld—Aiur—from the zerg Swarm, but an ancient evil looms. Only you can unite your people and oppose the coming darkness before it consumes the galaxy. ',
                'keywords' => 'starcratf, blizzard, zerg, teran, Wings of Liberty, queen of blades, star, craft',
            ],
            [
                'id' => 6,
                'name' => 'The Elder Scrolls V: Skyrim',
                'updates' => 0,
                'description' => 'The Elder Scrolls V: Skyrim is an open world action role-playing video game developed by Bethesda Game Studios and published by Bethesda Softworks. It is the fifth main installment in The Elder Scrolls series, following The Elder Scrolls IV: Oblivion. Skyrim was released worldwide in November 2011 for Microsoft Windows, PlayStation 3, and Xbox 360. Three downloadable content (DLC) add-ons were released—Dawnguard, Hearthfire, and Dragonborn—which were repackaged into The Elder Scrolls V: Skyrim – Legendary Edition, which was released in June 2013. The Elder Scrolls V: Skyrim – Special Edition, a remastered version of the game, was released for Windows, Xbox One, and PlayStation 4 in October 2016, including all three DLC expansions and a complete graphical upgrade, along with additional features. A port for Nintendo Switch is planned for release in 2017.

Skyrim\'s main story revolves around the player character and their effort to defeat Alduin the World-Eater, a dragon who is prophesied to destroy the world. The game is set two hundred years after the events of Oblivion, and takes place in the fictional province of Skyrim. Over the course of the game, the player completes quests and develops the character by improving skills. Skyrim continues the open world tradition of its predecessors by allowing the player to travel anywhere in the game world at any time, and to ignore or postpone the main storyline indefinitely.

The game was developed using the Creation Engine, rebuilt specifically for the game. The team opted for a unique and more diverse game world than Oblivion\'s Cyrodiil, which game director and executive producer Todd Howard considered less interesting by comparison. Skyrim was released to critical acclaim, with reviewers particularly mentioning the character development and setting, and is considered to be one of the greatest video games of all time. The game shipped over seven million copies to retailers within the first week of its release, and sold over 30 million copies across all platforms.',
                'keywords' => 'The Elder Scrolls, Skyrim, rpg, dragons, dovakhin, Bethesda Softworks',
            ],
            [
                'id' => 7,
                'name' => 'Counter-Strike: Global Offensive',
                'updates' => 0,
                'description' => 'Counter-Strike: Global Offensive (CS:GO) expands upon the team-based action gameplay that the franchise pioneered when it was launched 12 years ago.

CS:GO features new maps, characters, and weapons and delivers updated versions of the classic CS content (de_dust, etc.). In addition, CS:GO introduces new gameplay modes, matchmaking, leader boards, and more.',
                'keywords' => 'cs, counter strike, rush b, valve, gaben',
            ],
            [
                'id' => 8,
                'name' => 'Battlefield 3',
                'updates' => 0,
                'description' => 'In Battlefield 3, players stepped into the role of the elite U.S. Marines. As the first boots on the ground, players experienced heart-pounding missions across diverse locations including France, Middle-East, and New York. As a U.S. Marine in the field, periods of tension and anticipation were punctuated by moments of complete chaos.

As bullets whizzed by, as walls crumbled, as explosions forced players to the ground, the battlefield felt more alive and interactive than ever before.
',
                'keywords' => 'battlefield, ea, war, fps, first person shooter',
            ],
            [
                'id' => 9,
                'name' => 'Fallout 4',
                'updates' => 0,
                'description' => 'Bethesda Game Studios, the award-winning creators of Fallout 3 and Skyrim, welcomes you to the world of Fallout 4. Winner of more than 50 Game of the Year awards, including top honors at the 2016 D.I.C.E. Awards. Fallout 4 is the studio’s most ambitious game ever and the next generation of open-world gaming. As the sole survivor of Vault 111, you enter a world destroyed by nuclear war. Only you can rebuild and determine the fate of the Wasteland.',
                'keywords' => 'Fallout, rpb, Bethesda Game Studios, apocalypse',
            ],
            [
                'id' => 10,
                'name' => 'Guild Wars 2',
                'updates' => 0,
                'description' => 'Guild Wars 2 represents ArenaNet’s attempt to turn MMO convention on its ears and create an engaging game for players of all skill levels and play styles. It does away with typical things like the holy trinity (tank, healer, DPS) and eschews traditional group mechanics for open-world content, which anyone can join in on without hampering other players’ efforts. Even crafting nodes are shareable; there’s no competition for resources or other rewards.

Guild Wars 2 offers several different types of gameplay. In addition to the open-world content, there’s structured PvP, which pits teams of five players against each other, and World vs. World, a series of open-world PvP maps where players fight over castles and other fortified (and un-fortified) spots to bring their home world to victory. Characters are autoleveled to 80 in each case, so you can jump right in and start enjoying these parts of the game immediately (though the free-to-play version of the game does have its limitations).

ArenaNet is committed to a “no grind” philosophy for Guild Wars 2, in terms of gear progression. Top-tier stat gear is relatively easy to get, and the high-end gameplay typically revolves around acquiring new and different skins to customize your character’s look, rather than to simply provide bigger stat bonuses. This applies to the expansions, too, which ArenaNet has said will never raise the level cap above 80, making the game easy to jump into for both new players and those who have come back to the game after a long absence.',
                'keywords' => 'gl, guild wars, mmorpg',
            ],
            [
                'id' => 11,
                'name' => 'The Legend of Zelda: Breath of the Wild',
                'updates' => 0,
                'description' => 'Forget everything you know about The Legend of Zelda games. Step into a world of discovery, exploration and adventure in The Legend of Zelda: Breath of the Wild, a boundary-breaking new game in the acclaimed series. Travel across fields, through forests and to mountain peaks as you discover what has become of the ruined kingdom of Hyrule in this stunning open-air adventure.',
                'keywords' => 'The Legend of Zelda: Breath of the Wild, zelda, link, rpg, The Legend of Zelda',
            ],
        ];
    }

    private function getImageData() {
        return [
            [
                'id' => 1,
                'name' => 'legion',
                'title' => 'World of Warcraft: Legion',
                'alt' => 'World of Warcraft: Legion',
                'rel_id' => 1,
                'rel_type' => 1,
            ],
            [
                'id' => 2,
                'name' => 'lol',
                'title' => 'League of Legends',
                'alt' => 'League of Legends',
                'rel_id' => 2,
                'rel_type' => 1,
            ],
            [
                'id' => 3,
                'name' => 'hearthstone',
                'title' => 'Hearthstone',
                'alt' => 'Hearthstone',
                'rel_id' => 3,
                'rel_type' => 1,
            ],
            [
                'id' => 4,
                'name' => 'overwatch',
                'title' => 'Overwatch',
                'alt' => 'Overwatch',
                'rel_id' => 4,
                'rel_type' => 1,
            ],
            [
                'id' => 5,
                'name' => 'sc',
                'title' => 'Starcraft 2',
                'alt' => 'Starcraft 2',
                'rel_id' => 5,
                'rel_type' => 1,
            ],
            [
                'id' => 6,
                'name' => 'skyrim',
                'title' => 'Elder Scrolls: Skyrim',
                'alt' => 'Elder Scrolls: Skyrim',
                'rel_id' => 6,
                'rel_type' => 1,
            ],
            [
                'id' => 7,
                'name' => 'cs-go',
                'title' => 'Counter Strike: Global Offensive',
                'alt' => 'Counter Strike: Global Offensive',
                'rel_id' => 7,
                'rel_type' => 1,
            ],
            [
                'id' => 8,
                'name' => 'battlefield-3',
                'title' => 'Battlefield 3',
                'alt' => 'Battlefield 3',
                'rel_id' => 8,
                'rel_type' => 1,
            ],
            [
                'id' => 9,
                'name' => 'fallout-4',
                'title' => 'Fallout 4',
                'alt' => 'Fallout 4',
                'rel_id' => 9,
                'rel_type' => 1,
            ],
            [
                'id' => 10,
                'name' => 'guild-wars-2',
                'title' => 'Guild Wars 2',
                'alt' => 'Guild Wars 2',
                'rel_id' => 10,
                'rel_type' => 1,
            ],
            [
                'id' => 11,
                'name' => 'zelda-breath-of-the-wild',
                'title' => 'Zelda: Breath of the Wild',
                'alt' => 'Zelda: Breath of the Wild',
                'rel_id' => 11,
                'rel_type' => 1,
            ],
        ];
    }

    public function safeDown() {
        
    }

}
