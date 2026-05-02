# Pediatric Teledermatology Platform

A minimal web application for remote pediatric dermatology consultations.

---

## Tech Stack
- **Backend:** Laravel
- **Frontend:** Blade + Tailwind CSS
- **Database:** MySQL

---

## System Overview
![Overview](./assets/overview.png)

## Medical Consultation Sequence Diagram
![Sequence](./assets/sequence.png)

> [!NOTE]  
> This sequence diagram illustrates the core medical consultation workflow between Patient and Doctor. Admin actions are excluded from the diagram as they are not part of the primary consultation flow.

---

## Features Planned (MVP)

- Authentication & RBAC (Doctor/Patient/Admin)

- Patients/Parents:
    - Upload case images + descriptions (and other relevant info) for consultation.
    - View status of their uploaded cases and the diagnosis and treatment plans provided by the doctor.

- Doctors:
    - View all cases uploaded by patients (no assignment system for the MVP).
    - Add diagnosis and treatment plans to cases.

- Admins:
    - View all users.
    - Delete users.
    - View all submitted cases (read-only).

---
