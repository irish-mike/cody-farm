# Cody Farm

Cody Farm is a Laravel-based project that automates gameplay in **Codyfight**, an online futuristic battle game where players can control fighters manually or build bots to play on their behalf. This project focuses on building an intelligent bot using game strategies to take turns, perform actions, and win battles.

## Quick Links

- [API Documentation](https://game.codyfight.com)
- [Codyfighters Guide](https://codyfight.com/codyfighters)

## Dependencies

- **PHP**: 8.2
- **Laravel**: 11.9
- **Composer**: 2.7.9


## Installation Guide

1. **Clone the repository**:
   ```bash
   git clone https://github.com/irish-mike/cody_farm.git
   cd cody_farm
   ```

2. **Install dependencies**:
   ```bash
   composer install
   ```

3. **Set up environment**:
    - Copy `.env.example` to `.env`:
      ```bash
      cp .env.example .env
      ```
    - Update the `.env` file with your API key and environment variables.

4. **Run the application**:
   ```bash
   php artisan serve
   ```

5. **Run the game command**:
   ```bash
   php artisan app:play
   ```
   This command initializes the bot, starts the game, and plays via the Codyfight API.

## Main Classes 

- **Game**: Manages the overall gameplay, initializing the game state, handling turns, and interacting with the API.
- **Bot**: Represents the player, handles managing its state position, skills, and available moves.
- **GameRequestService**: Handles communication with the API.
- **StrategyManager**: Calculates the next moved based on decision-making strategies.
- **MoveStrategy**: Determines next move for the bot based on the current game state and available moves.
- **CastStrategy**: Determines what skill to cast and what to target.


## Future Improvements

- **Command Updates**: Update the `app:play` command to accept parameters for game configuration, such as bot type, game mode, and opponent.
- **Map Class**: Create a `Map` class to encapsulate and handle logic related to the game map.
- **Strategy Management**: Move strategy management to the `Bot` class so that it handles its own decision-making. Seperate strategies for pathfinding, casting logic, and decision-making.
