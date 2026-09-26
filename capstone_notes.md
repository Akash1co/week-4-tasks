# Capstone Project Presentation Notes (5 Minutes)

## 1. Project Overview & Architecture (1 Minute)
- **Project Name:** Portfolio CMS & Blog Management System
- **Framework:** Laravel 11 (PHP 8.x) with SQLite / MySQL database.
- **Core Purpose:** A full-stack web application designed for publishing, managing, and consuming post content with user authentication, database relationships, and RESTful API access.

## 2. Key Features Implemented (2 Minutes)
- **Authentication & Authorization:** Secure registration, login, session management, and protected routes powered by Laravel Breeze/Sanctum.
- **Database Schema & Eloquent ORM:** `User` and `Post` models connected with a 1-to-Many relationship (`User hasMany Posts`, `Post belongsTo User`).
- **REST API Endpoints:** JSON resources for retrieving and interacting with post data programmatically.
- **Automated Testing Suite:** 5 comprehensive PHPUnit feature tests verifying authentication, post creation, database persistence, updates, and soft/hard deletions.

## 3. Challenges & Technical Solutions (1 Minute)
- **Database Migration & Schema Alignment:** Resolved column naming mismatches and enforced foreign key constraints (`user_id` mapped to `users` table with cascade delete).
- **Model Mass Assignment:** Configured `$fillable` fields on the `Post` model and associated `PostFactory` for seamless testing and seed generation.
- **Test Isolation:** Utilized the `RefreshDatabase` trait to ensure a clean database state across unit and feature test executions.

## 4. Future Improvements & Portfolio Potential (1 Minute)
- Implement post category tagging and comment threads.
- Integrate rich-text Markdown editing for post content.
- Deploy live instance to Hostinger/Vercel with CI/CD GitHub Actions workflow.