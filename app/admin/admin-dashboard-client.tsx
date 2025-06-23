"use client"

import React, { useState, useEffect } from "react"
import dynamic from "next/dynamic"
import AdminNavbar from "@/components/admin/admin-navbar"
import HomeDashboard from "@/components/admin/home-dashboard"
import { CrudTable } from "@/components/admin/crud-table"
import { Button } from "@/components/ui/button"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Textarea } from "@/components/ui/textarea"
import toast from "react-hot-toast"

const ProfileForm = dynamic(() => import("@/components/admin/profile-form"), { ssr: false })
const EducationForm = dynamic(() => import("@/components/admin/education-form"), { ssr: false })
const ContactInfoForm = dynamic(() => import("@/components/admin/contact-info-form"), { ssr: false })
const CertificatesForm = dynamic(() => import("@/components/admin/certificates-form"), { ssr: false })
const ProjectForm = dynamic(() => import("@/components/admin/project-form"), { ssr: false })
const EnhancedProjectForm = dynamic(() => import("@/components/admin/enhanced-project-form"), { ssr: false })

// Placeholder components for new sections
import StudentDeveloperForm from "@/components/admin/student-developer-form"
import MyStoryForm from "@/components/admin/my-story-form"
import PersonalInfoForm from "@/components/admin/personal-info-form"
import TechnicalSkillsForm from "@/components/admin/technical-skills-form"
import WhatIDoForm from "@/components/admin/what-i-do-form"
type Section =
  | "home"
  | "profile"
  | "education"
  | "contact"
  | "certificates"
  | "projects"
  | "studentDeveloper"
  | "myStory"
  | "personalInfo"
  | "technicalSkills"
  | "whatIDo"

export default function AdminDashboardClient() {
  const [activeSection, setActiveSection] = useState<Section>("home")
  const [refreshKey, setRefreshKey] = useState(0)

  // State for CRUD data and editing
  const [editingItem, setEditingItem] = useState<any | null>(null)
  const [data, setData] = useState<any[]>([])
  const [loading, setLoading] = useState(false)

  const handleSave = () => {
    setRefreshKey((prev) => prev + 1)
    setEditingItem(null)
  }

  // Fetch data for current section
  useEffect(() => {
    async function fetchData() {
      setLoading(true)
      try {
        let url = ""
        switch (activeSection) {
          case "profile":
            url = "/api/profile"
            break
          case "education":
            url = "/api/education"
            break
          case "contact":
            url = "/api/contact"
            break
          case "certificates":
            url = "/api/certificates"
            break
          case "projects":
            url = "/api/projects"
            break
          case "studentDeveloper":
            url = "/api/student-developer"
            break
          case "myStory":
            url = "/api/my-story"
            break
          case "personalInfo":
            url = "/api/personal-info"
            break
          case "technicalSkills":
            url = "/api/technical-skills"
            break
          case "whatIDo":
            url = "/api/what-i-do"
            break
          default:
            url = ""
        }
        if (url) {
          const res = await fetch(url)
          if (!res.ok) throw new Error("Failed to fetch data")
          const json = await res.json()
          setData(Array.isArray(json) ? json : [json])
        } else {
          setData([])
        }
      } catch (error) {
        toast.error("Failed to load data")
        setData([])
      } finally {
        setLoading(false)
      }
    }
    fetchData()
  }, [activeSection, refreshKey])

  // Columns for tables per section
  const columnsMap: Record<string, { header: string; accessor: string }[]> = {
    education: [
      { header: "Level", accessor: "level" },
      { header: "Institution", accessor: "institution" },
      { header: "Period", accessor: "period" },
    ],
    certificates: [
      { header: "Title", accessor: "title" },
      { header: "Issuer", accessor: "issuer" },
      { header: "Date", accessor: "date" },
    ],
    projects: [
      { header: "Name", accessor: "name" },
      { header: "Description", accessor: "description" },
      { header: "Year", accessor: "year" },
    ],
    // Add other sections as needed
  }

  // Render form or table based on active section and editing state
  const renderContent = () => {
    switch (activeSection) {
      case "profile":
        if (editingItem) {
          return <ProfileForm key={refreshKey} onSave={handleSave} />
        }
        return (
          <CrudTable
            columns={[
              { header: "Title", accessor: "title" },
              { header: "Content", accessor: "content" },
            ]}
            data={data}
            onEdit={(item) => setEditingItem(item)}
            onDelete={(item) => {
              toast.success("Deleted profile entry (not implemented)")
            }}
            loading={loading}
          />
        )
      case "education":
        if (editingItem) {
          return (
            <EducationForm
              key={refreshKey}
              entryId={editingItem.id}
              onSave={handleSave}
              onCancel={() => setEditingItem(null)}
            />
          )
        }
        return (
          <>
            <Button onClick={() => setEditingItem({})} className="mb-4">
              Add Education
            </Button>
            <CrudTable
              columns={[
                { header: "Level", accessor: "level" },
                { header: "Institution", accessor: "institution" },
                { header: "Period", accessor: "period" },
              ]}
              data={data}
              onEdit={(item) => setEditingItem(item)}
              onDelete={(item) => {
                toast.success("Deleted education entry (not implemented)")
              }}
              loading={loading}
            />
          </>
        )
      case "contact":
        if (editingItem) {
          return <ContactInfoForm key={refreshKey} onSave={handleSave} />
        }
        return (
          <CrudTable
            columns={[
              { header: "Type", accessor: "type" },
              { header: "Value", accessor: "value" },
            ]}
            data={data}
            onEdit={(item) => setEditingItem(item)}
            onDelete={(item) => {
              toast.success("Deleted contact info entry (not implemented)")
            }}
            loading={loading}
          />
        )
      case "certificates":
        if (editingItem) {
          return <CertificatesForm key={refreshKey} onSave={handleSave} />
        }
        return (
          <CrudTable
            columns={[
              { header: "Title", accessor: "title" },
              { header: "Issuer", accessor: "issuer" },
              { header: "Date", accessor: "date" },
            ]}
            data={data}
            onEdit={(item) => setEditingItem(item)}
            onDelete={(item) => {
              toast.success("Deleted certificate entry (not implemented)")
            }}
            loading={loading}
          />
        )
      case "projects":
        if (editingItem) {
          return (
            <ProjectForm
              key={refreshKey}
              project={editingItem}
              onSubmit={async () => {}}
              onCancel={() => setEditingItem(null)}
            />
          )
        }
        return (
          <>
            <Button onClick={() => setEditingItem({})} className="mb-4">
              Add Project
            </Button>
            <CrudTable
              columns={[
                { header: "Title", accessor: "title" },
                { header: "Category", accessor: "category" },
                { header: "Featured", accessor: "featured" },
              ]}
              data={data}
              onEdit={(item) => setEditingItem(item)}
              onDelete={(item) => {
                toast.success("Deleted project entry (not implemented)")
              }}
              loading={loading}
            />
          </>
        )
      case "studentDeveloper":
        if (editingItem) {
          return (
            <StudentDeveloperForm
              entryId={editingItem.id}
              onSave={handleSave}
              onCancel={() => setEditingItem(null)}
            />
          )
        }
        return (
          <>
            <Button onClick={() => setEditingItem({})} className="mb-4">
              Add Student Developer
            </Button>
            <CrudTable
              columns={[
                { header: "Description", accessor: "description" },
              ]}
              data={data}
              onEdit={(item) => setEditingItem(item)}
              onDelete={async (item) => {
                if (confirm("Are you sure you want to delete this entry?")) {
                  try {
                    const res = await fetch(`/api/student-developer?id=${item.id}`, { method: "DELETE" })
                    if (!res.ok) throw new Error("Failed to delete")
                    toast.success("Deleted student developer entry")
                    setRefreshKey((prev) => prev + 1)
                  } catch {
                    toast.error("Failed to delete student developer entry")
                  }
                }
              }}
              loading={loading}
            />
          </>
        )
      case "myStory":
        if (editingItem) {
          return (
            <MyStoryForm
              entryId={editingItem.id}
              onSave={handleSave}
              onCancel={() => setEditingItem(null)}
            />
          )
        }
        return (
          <>
            <Button onClick={() => setEditingItem({})} className="mb-4">
              Add My Story
            </Button>
            <CrudTable
              columns={[
                { header: "Title", accessor: "title" },
                { header: "Content", accessor: "content" },
              ]}
              data={data}
              onEdit={(item) => setEditingItem(item)}
              onDelete={async (item) => {
                if (confirm("Are you sure you want to delete this entry?")) {
                  try {
                    const res = await fetch(`/api/my-story?id=${item.id}`, { method: "DELETE" })
                    if (!res.ok) throw new Error("Failed to delete")
                    toast.success("Deleted my story entry")
                    setRefreshKey((prev) => prev + 1)
                  } catch {
                    toast.error("Failed to delete my story entry")
                  }
                }
              }}
              loading={loading}
            />
          </>
        )
      case "personalInfo":
        if (editingItem) {
          return (
            <PersonalInfoForm
              entryId={editingItem.id}
              onSave={handleSave}
              onCancel={() => setEditingItem(null)}
            />
          )
        }
        return (
          <>
            <Button onClick={() => setEditingItem({})} className="mb-4">
              Add Personal Info
            </Button>
            <CrudTable
              columns={[
                { header: "Label", accessor: "label" },
                { header: "Value", accessor: "value" },
              ]}
              data={data}
              onEdit={(item) => setEditingItem(item)}
              onDelete={async (item) => {
                if (confirm("Are you sure you want to delete this entry?")) {
                  try {
                    const res = await fetch(`/api/personal-info?id=${item.id}`, { method: "DELETE" })
                    if (!res.ok) throw new Error("Failed to delete")
                    toast.success("Deleted personal info entry")
                    setRefreshKey((prev) => prev + 1)
                  } catch {
                    toast.error("Failed to delete personal info entry")
                  }
                }
              }}
              loading={loading}
            />
          </>
        )
      case "technicalSkills":
        if (editingItem) {
          return (
            <TechnicalSkillsForm
              entryId={editingItem.id}
              onSave={handleSave}
              onCancel={() => setEditingItem(null)}
            />
          )
        }
        return (
          <>
            <Button onClick={() => setEditingItem({})} className="mb-4">
              Add Technical Skill
            </Button>
            <CrudTable
              columns={[
                { header: "Skill Name", accessor: "skill_name" },
                { header: "Proficiency", accessor: "proficiency" },
              ]}
              data={data}
              onEdit={(item) => setEditingItem(item)}
              onDelete={async (item) => {
                if (confirm("Are you sure you want to delete this entry?")) {
                  try {
                    const res = await fetch(`/api/technical-skills?id=${item.id}`, { method: "DELETE" })
                    if (!res.ok) throw new Error("Failed to delete")
                    toast.success("Deleted technical skill entry")
                    setRefreshKey((prev) => prev + 1)
                  } catch {
                    toast.error("Failed to delete technical skill entry")
                  }
                }
              }}
              loading={loading}
            />
          </>
        )
      case "whatIDo":
        if (editingItem) {
          return (
            <WhatIDoForm
              entryId={editingItem.id}
              onSave={handleSave}
              onCancel={() => setEditingItem(null)}
            />
          )
        }
        return (
          <>
            <Button onClick={() => setEditingItem({})} className="mb-4">
              Add What I Do
            </Button>
            <CrudTable
              columns={[
                { header: "Title", accessor: "title" },
                { header: "Description", accessor: "description" },
              ]}
              data={data}
              onEdit={(item) => setEditingItem(item)}
              onDelete={async (item) => {
                if (confirm("Are you sure you want to delete this entry?")) {
                  try {
                    const res = await fetch(`/api/what-i-do?id=${item.id}`, { method: "DELETE" })
                    if (!res.ok) throw new Error("Failed to delete")
                    toast.success("Deleted what I do entry")
                    setRefreshKey((prev) => prev + 1)
                  } catch {
                    toast.error("Failed to delete what I do entry")
                  }
                }
              }}
              loading={loading}
            />
          </>
        )
      default:
        return <HomeDashboard />
    }
  }

  return (
    <div className="flex flex-col min-h-screen bg-background text-foreground font-sans">
      <AdminNavbar />
      <div className="flex flex-1 max-w-7xl mx-auto p-6 space-x-8">
        {/* Sidebar */}
        <aside className="w-64 bg-card shadow-professional rounded-lg flex flex-col overflow-hidden fixed left-0 top-16 h-[calc(100vh-4rem)] z-40">
          <div className="px-6 py-6 border-b border-border bg-gradient-to-r from-primary/10 to-secondary/10">
            <h2 className="text-xl font-extrabold text-primary">Manage your portfolio projects and content</h2>
          </div>
          <nav className="flex-1 overflow-y-auto px-4 py-6 space-y-3">
            <ul>
              <li>
                <button
                  className={`w-full text-left px-5 py-3 rounded-lg font-semibold transition-colors duration-300 ${
                    activeSection === "home"
                      ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                      : "hover:bg-primary/10 hover:text-primary"
                  }`}
                  onClick={() => setActiveSection("home")}
                >
                  Home
                </button>
              </li>
              <li>
                <button
                  className={`w-full text-left px-5 py-3 rounded-lg font-semibold transition-colors duration-300 ${
                    activeSection === "profile"
                      ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                      : "hover:bg-primary/10 hover:text-primary"
                  }`}
                  onClick={() => setActiveSection("profile")}
                >
                  Profile
                </button>
              </li>
              <li>
                <div className="px-5 py-3 font-bold text-primary">About</div>
                <ul className="ml-4 space-y-2">
                  <li>
                    <button
                      className={`w-full text-left px-5 py-2 rounded-lg font-semibold transition-colors duration-300 ${
                        activeSection === "studentDeveloper"
                          ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                          : "hover:bg-primary/10 hover:text-primary"
                      }`}
                      onClick={() => setActiveSection("studentDeveloper")}
                    >
                      Student Developer
                    </button>
                  </li>
                  <li>
                    <button
                      className={`w-full text-left px-5 py-2 rounded-lg font-semibold transition-colors duration-300 ${
                        activeSection === "myStory"
                          ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                          : "hover:bg-primary/10 hover:text-primary"
                      }`}
                      onClick={() => setActiveSection("myStory")}
                    >
                      My Story
                    </button>
                  </li>
                  <li>
                    <button
                      className={`w-full text-left px-5 py-2 rounded-lg font-semibold transition-colors duration-300 ${
                        activeSection === "personalInfo"
                          ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                          : "hover:bg-primary/10 hover:text-primary"
                      }`}
                      onClick={() => setActiveSection("personalInfo")}
                    >
                      Personal Info
                    </button>
                  </li>
                </ul>
              </li>
              <li>
                <button
                  className={`w-full text-left px-5 py-3 rounded-lg font-semibold transition-colors duration-300 ${
                    activeSection === "education"
                      ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                      : "hover:bg-primary/10 hover:text-primary"
                  }`}
                  onClick={() => setActiveSection("education")}
                >
                  Education
                </button>
              </li>
              <li>
                <button
                  className={`w-full text-left px-5 py-3 rounded-lg font-semibold transition-colors duration-300 ${
                    activeSection === "certificates"
                      ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                      : "hover:bg-primary/10 hover:text-primary"
                  }`}
                  onClick={() => setActiveSection("certificates")}
                >
                  Certificates
                </button>
              </li>
              <li>
                <button
                  className={`w-full text-left px-5 py-3 rounded-lg font-semibold transition-colors duration-300 ${
                    activeSection === "technicalSkills"
                      ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                      : "hover:bg-primary/10 hover:text-primary"
                  }`}
                  onClick={() => setActiveSection("technicalSkills")}
                >
                  Technical Skills
                </button>
              </li>
              <li>
                <button
                  className={`w-full text-left px-5 py-3 rounded-lg font-semibold transition-colors duration-300 ${
                    activeSection === "whatIDo"
                      ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                      : "hover:bg-primary/10 hover:text-primary"
                  }`}
                  onClick={() => setActiveSection("whatIDo")}
                >
                  What I Do
                </button>
              </li>
              <li>
                <button
                  className={`w-full text-left px-5 py-3 rounded-lg font-semibold transition-colors duration-300 ${
                    activeSection === "projects"
                      ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                      : "hover:bg-primary/10 hover:text-primary"
                  }`}
                  onClick={() => setActiveSection("projects")}
                >
                  Projects
                </button>
              </li>
              <li>
                <button
                  className={`w-full text-left px-5 py-3 rounded-lg font-semibold transition-colors duration-300 ${
                    activeSection === "contact"
                      ? "bg-primary text-primary-foreground shadow-lg shadow-primary/30"
                      : "hover:bg-primary/10 hover:text-primary"
                  }`}
                  onClick={() => setActiveSection("contact")}
                >
                  Contact Info
                </button>
              </li>
            </ul>
          </nav>
        </aside>

        {/* Content */}
        <main className="flex-1 p-8 overflow-auto bg-card rounded-lg shadow-professional">
          {activeSection === "home" && <HomeDashboard />}
          {activeSection === "profile" && <ProfileForm key={refreshKey} onSave={handleSave} />}
          {activeSection === "education" && !editingItem && (
            <>
              <Button onClick={() => setEditingItem({})} className="mb-4">
                Add Education
              </Button>
              <CrudTable
                columns={columnsMap.education}
                data={data}
                onEdit={(item) => setEditingItem(item)}
                onDelete={(item) => {
                  // Implement delete logic here
                  toast.success("Deleted education entry (not implemented)")
                }}
                loading={loading}
              />
            </>
          )}
          {activeSection === "education" && editingItem && (
            <EducationForm
              key={refreshKey}
              entryId={editingItem.id}
              onSave={handleSave}
              onCancel={() => setEditingItem(null)}
            />
          )}
          {activeSection === "contact" && <ContactInfoForm key={refreshKey} onSave={handleSave} />}
          {activeSection === "certificates" && <CertificatesForm key={refreshKey} onSave={handleSave} />}
          {activeSection === "projects" && (
            <>
