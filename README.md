# Cody Farm

Cody Farm is a Laravel-based project for playing the Codyfight game.

## Codyfight Overview

Codyfight is a free, browser-based online game set in a futuristic universe where players control battle-ready fighters to save the planet from destruction.

You can play yourself or build a bot to play for you.

Collect and upgrade Codyfighters, defeat the evil Mr. Ryo, or earn Llama’s blessing to win in the Arena.

## Quick Links

- [API Documentation](https://game.codyfight.com)
- [Codyfighters Guide](https://codyfight.com/codyfighters)

## Requirements

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
    - Update the `.env` file with your settings.

4. **Run the application**:
   ```bash
   php artisan serve
   ```
