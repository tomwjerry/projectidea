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
    case MemberPermission = 26;

    case IssueList = 41;
    case IssueRead = 42;
    case IssueCreate = 43;
    case IssueEdit = 44;
    case IssueDelete = 45;

    case IssueCommentList = 61;
    case IssueCommentRead = 62;
    case IssueCommentCreate = 63;
    case IssueCommentEdit = 64;
    case IssueCommentDelete = 65;

    case ProjectBoardList = 81;
    case ProjectBoardRead = 82;
    case ProjectBoardCreate = 83;
    case ProjectBoardEdit = 84;
    case ProjectBoardDelete = 85;

    case BoardLayoutList = 101;
    case BoardLayoutRead = 102;
    case BoardLayoutCreate = 103;
    case BoardLayoutEdit = 104;
    case BoardLayoutDelete = 105;

    case DashboardList = 141;
    case DashboardRead = 142;
    case DashboardCreate = 143;
    case DashboardEdit = 144;
    case DashboardDelete = 145;
}
