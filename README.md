# Unified Secondary Education Management System (USEMS)

A Centralized Digital Platform for Malawi's Education Sector

Prepared for: Ministry of Education, Malawi

## Project Scope

USEMS supports:
- Resource distribution and syllabus sharing
- Offline grade management for teachers
- Cluster collaboration for mock exam standardization

Technical Framework:
- Backend: Laravel 11
- Mobile/Web: Flutter
- Database: MySQL
- Hosting: Local or cloud deployments with data sovereignty options

## 1. Project Overview

USEMS is a strategic digital initiative designed to harmonize secondary education across Malawi. By centralizing teaching resources, standardizing mock examinations, and digitizing grade management, the platform bridges the gap between urban and rural educational standards.

### What "Unified" Means

- Unified Standards: Equal access to high-quality materials for both National Schools and Community Day Secondary Schools (CDSS).
- Unified Communication: A direct digital link between classroom teachers and the Ministry of Education (MoE).
- Unified Data: A single, secure source of truth for student performance nationwide.

## 2. Core Capabilities

### 2.1 Connectivity Resilience (Offline-First)

Designed for the Malawian context, USEMS ensures functionality regardless of internet stability:
- Offline Grade Entry: Teachers can record marks locally on their devices; data syncs automatically once a connection is detected.
- Local Persistence: Uses SQLite within the Flutter app to maintain a fast, reactive experience without a live server connection.
- Resource Pre-loading: Teachers can download syllabus materials while in high-connectivity areas for later use in the classroom.

### 2.2 Data Privacy & Security

The system utilizes Laravel's enterprise-grade security features:
- Role-Based Access Control (RBAC): Strict permissions ensure users only see data relevant to their role.
- Data Encryption: All sensitive records are encrypted at rest (AES-256) and in transit (SSL/TLS).
- Audit Trails: Every entry and modification is logged to prevent grade tampering and ensure accountability.

## 3. Technical Architecture

| Component | Technology | Rationale |
| --- | --- | --- |
| Backend (API) | Laravel 11 | Provides a secure, robust brain for the system and handles complex logic and database management. |
| Mobile/Web App | Flutter | A single codebase for Android, iOS, and Web with a clean, conversational UI. |
| Database | MySQL | Relational storage optimized for complex reporting and Ministry analytics. |
| Hosting | Local / Cloud | Flexible deployment options to ensure data sovereignty within Malawi. |

## 4. User Interface (UX)

To ensure high adoption and minimal training, USEMS adopts a minimalist ChatGPT-style interface focused on one task at a time:

- Sidebar: Recent Classes, Mock Exams, MoE Initiatives
- Main view: Personalized action prompts such as uploading notes, entering marks, and submitting innovations
- Status bar: Sync and offline indicators with pending changes count

Example interface:

> [ Sidebar: Recent Classes | Mock Exams | MoE Initiatives ]
> ----------------------------------------------------------
> [ Main: Hello, Mr. Banda. Select an action below: ]
> ( + ) Upload Form 3 Biology Notes
> ( + ) Input Mathematics Term Marks
> ( + ) Submit Innovation to Ministry
> ----------------------------------------------------------
> [ Status: Offline - 12 changes pending sync... ]

## 5. Stakeholder Roles

- Teachers: Upload notes, enter grades offline, and submit pedagogical innovations.
- Cluster Leaders: Review and standardize mock exam papers across the district.
- Headteachers: Verify school-level data and generate digital report cards.
- Ministry Officials: Access national performance dashboards and review policy input from teachers.

## 6. Implementation Roadmap

1. Phase 1: MVP launch focusing on Resource Repository and Offline Grade Entry in 10 pilot schools.
2. Phase 2: Deployment of the Cluster Review and Ministry Initiative modules.
3. Phase 3: National scaling and integration with existing government databases.
