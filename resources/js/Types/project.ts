import type {User} from "@/js/Types/user";

export interface Project {
    id: number
    title: string
    description: string
    created_at: string
    created_ago: string
    updated_at: string
    user_id: number
    user: User
}
