import type {User} from "@/js/Types/user";
import type {Project} from "@/js/Types/project";

export interface Task {
    id: number;
    name: string;
    description: string;
    created_at: string;
    updated_at: string;
    project_id: number;
    user_id: number;
    status: string;
    priority: number;

    user: User,
    project: Project,
}
