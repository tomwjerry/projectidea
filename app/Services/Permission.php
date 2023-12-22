<?php
namespace App\Services;

enum Permission: int
{
    case ProjectList = 1;
    case ProjectRead = 2;
    case ProjectCreate = 3;
    case ProjectEdit = 4;
    case ProjectDelete = 5;

    case MemberList = 21;
    case MemberRead = 22;
    case MemberCreate = 23;
    case MemberEdit = 24;
    case MemberDelete = 25;

    case IssueList = 41;
    case IssueRead = 42;
    case IssueCreate = 43;
    case IssueEdit = 44;
    case IssueDelete = 45;

    case DashboardList = 101;
    case DashboardRead = 102;
    case DashboardCreate = 103;
    case DashboardEdit = 104;
    case DashboardDelete = 105;
}
